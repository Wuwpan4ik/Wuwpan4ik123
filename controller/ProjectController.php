<?php
    class ProjectController extends ACore
    {
        private function isUser($checkId)
        {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function addVideo () {
            $uid = $_GET['id'];

            $res = $this->m->db->query("SELECT * FROM course WHERE id = '$uid' ORDER BY `id` DESC LIMIT 1");

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], "./uploads/projects/".$uid."_".$res[0]['name']."/".$_FILES['video_uploader']['name']);

            $path = "./uploads/projects/$uid"."_".$res[0]['name']."/".$_FILES['video_uploader']['name'];

            $this->m->db->execute("INSERT INTO course_content (`course_id`, `name`, `description`, `video`) VALUES (".$res[0]['id'].",'Укажите заголовок','Укажите описание', '$path')");
        }

        public function renameVideo() {
            $courseContent = $this->m->db->query("SELECT * FROM `course_content` WHERE id = ".$_GET['id_item']);
            $res = $this->m->db->query("SELECT * FROM `course` WHERE id = ".$courseContent[0]['course_id']);
            if (!$this->isUser($res[0]['author_id'])) return False;

            $name = $_POST['name'];
            $description = $_POST['description'];
            $button_text = $_POST['button_text'];
            $this->m->db->execute("UPDATE `course_content` SET `name` = '$name', `description` = '$description',
                            `button_text` = '$button_text' WHERE `id` = " . $_GET['id_item']);
            return True;
        }

        public function initVideoButton() {
            //Форма
            $id_video = $_POST['id_item'];
            if (!$this->isUser($id_video)) return False;
            if (isset($_POST['first_do'])) {
                $first_do = $_POST['first_do'];
            } else {
                return False;
            }
            if (isset($_POST['form_id-1'])) {
                $form_input_1 = $_POST['form_id-1'];
            }
            if (isset($_POST['form_id-2'])) {
                $form_input_2 = $_POST['form_id-2'];
            }
            if (isset($_POST['form_id-3'])) {
                $form_input_3 = $_POST['form_id-3'];
            }
            switch ($_POST['first_do']) {
                case "form": {
                    $videoBtnHTML = "";
                }
                case "list": {
                    $videoBtnHTML = "";
                }
                case "nextLesson": {
                    $videoBtnHTML = "";
                }
            }
            $this->m->db->execute("UPDATE `course_content` SET `after_video_view` = '$videoBtnHTML' WHERE id = '$id_video'");
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
                        optionName = "ProjectEdit"
                    } else {
                        optionName = "Project"
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