<?php
class VideoController extends ACore
{
    private function isUser($checkId)
    {
        return $_SESSION['user']['id'] == $checkId;
    }

    public function addVideo () {
        $uid = $_GET['id'];

        $folder = $_GET['folder'];

        if ($folder == 'funnel') {
            $res = $this->m->db->query("SELECT * FROM funnel WHERE id = '$uid' ORDER BY `id` DESC LIMIT 1");
        } elseif ($folder == 'course') {
            $res = $this->m->db->query("SELECT * FROM course WHERE id = '$uid' ORDER BY `id` DESC LIMIT 1");
        }

        move_uploaded_file($_FILES['video_uploader']['tmp_name'], "./uploads/$folder/".$uid."_".$res[0]['name']."/".$_FILES['video_uploader']['name']);

        $path = "./uploads/$folder/$uid"."_".$res[0]['name']."/".$_FILES['video_uploader']['name'];

        if ($folder == 'funnel') {
            $this->m->db->execute("INSERT INTO funnel_content (`funnel_id`, `name`, `description`, `video`) VALUES (".$res[0]['id'].",'Укажите заголовок','Укажите описание', '$path')");
        } elseif ($folder == 'course') {
            $this->m->db->execute("INSERT INTO course_content (`course_id`, `name`, `description`, `video`) VALUES (".$res[0]['id'].",'Укажите заголовок','Укажите описание', '$path')");
        }
    }

    public function renameVideo() {
        $funnelContent = $this->m->db->query("SELECT * FROM `funnel_content` WHERE id = ".$_GET['id_item']);
        $res = $this->m->db->query("SELECT * FROM `funnel` WHERE id = ".$funnelContent[0]['funnel_id']);
        if (!$this->isUser($res[0]['author_id'])) return False;

        $name = $_POST['name'];
        $description = $_POST['description'];
        $button_text = $_POST['button_text'];
        $this->m->db->execute("UPDATE `funnel_content` SET `name` = '$name', `description` = '$description',
                            `button_text` = '$button_text' WHERE `id` = " . $_GET['id_item']);
        return True;
    }

    public function initVideoButton() {
        //Форма
        $id_video = $_POST['id_item'];
        $this->m->db->query("SELECT * FROM funnel_content WHERE id = '$id_video'");
//        if (!$this->isUser($id_video[0]['author_id'])) return False;
        if (isset($_POST['first_do'])) {
            $first_do = $_POST['first_do'];
        } else {
            return False;
        }

        $videoBtnHTML = [];

        switch ($_POST['first_do']) {
            case "form": {
                if (isset($_POST['form_id-1'])) {
                    $form_input_1 = $_POST['form_id-1'];
                    $videoBtnHTML['form'] = [$form_input_1];
                }
                if (isset($_POST['form_id-2'])) {
                    $form_input_2 = $_POST['form_id-2'];
                    $videoBtnHTML['form'] = array_merge(array_values($videoBtnHTML['form']), [$form_input_2]);
                }
                if (isset($_POST['form_id-3'])) {
                    $form_input_3 = $_POST['form_id-3'];
                    $videoBtnHTML['form'] = array_merge(array_values($videoBtnHTML['form']), [$form_input_3]);
                }
                break;
            }
            case "list": {
                $videoBtnHTML['list'] = true;
                break;
            }
            case "nextLesson": {
                $videoBtnHTML['nextLessons'] = true;
                break;
            }
        }
        $videoBtnHTMLResult = json_encode($videoBtnHTML);
        $this->m->db->execute("UPDATE `funnel_content` SET `popup` = '$videoBtnHTMLResult' WHERE id = '$id_video'");
        $a = $this->m->db->query("SELECT * FROM funnel_content WHERE id = $id_video");
        return True;
    }


    public function get_content()
    {
        echo '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Document</title>
			</head>
			<body>
				<script>
				    let ur = document.URL;
                    var url = new URL(ur);
                    var option = url.searchParams.get("option");
                    var method = url.searchParams.get("method");
                    let id = url.searchParams.get("id");
                    let optionName = "";
                    let idNumber = "";
                    
                    if (method === "addVideo" || method === "renameVideo") {
                        if (option === "FunnelController") {
                            optionName = "FunnelEdit"
                        } else {
                            optionName = "CourseEdit"
                        }
                    } else {
                        if (option === "FunnelController") {
                            optionName = "Funnel"
                        } else {
                            optionName = "Course"
                        }
                    }
                    if (id) {
                        idNumber = \'&id=\' + id;
                    }
				    let a = location.protocol + \'//\' + location.host + location.pathname + \'?option=\' + optionName + idNumber;
					window.location.replace(a);
				</script>
			</body>
			</html>';
    }
}