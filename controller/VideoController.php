<?php
class VideoController extends ACore
{

    public function renameVideo() {
        $funnelContent = $this->m->db->query("SELECT * FROM `funnel_content` WHERE id = ".$_GET['id_item']);
        $res = $this->m->db->query("SELECT * FROM `funnel` WHERE id = ".$funnelContent[0]['funnel_id']);
        if (!$this->isUser($res[0]['author_id'])) return False;

        $name = $_POST['name'];
        $description = $_POST['description'];
        $this->m->db->execute("UPDATE `funnel_content` SET `name` = '$name', `description` = '$description' WHERE `id` = " . $_GET['id_item']);
        return True;
    }

    public function initVideoButton() {
        //Форма
        $id_video = $_SESSION['item_id'];
        $funnel = $this->m->db->query("SELECT * FROM funnel_content WHERE id = '$id_video'");
//        if (!$this->isUser($funnel[0]['author_id'])) return False;

        $videoBtnHTML = [];
        $first_do = $_POST['first_do'];
        $second_do = $_POST['second_do'];
        $button_text = $_POST['button_text'];
//      Проверка ддлины
        if (strlen($button_text) == 0) {
            $button_text = null;
        }
        switch ($_POST['first_do']) {
            case "pay_form":
            case "form": {
                if (isset($_POST['form_id-1'])) {
                    $form_input_1 = $_POST['form_id-1'];
                    $videoBtnHTML['first_do'][$first_do] = [$form_input_1];
                }
                if (isset($_POST['form_id-2'])) {
                    $form_input_2 = $_POST['form_id-2'];
                    $videoBtnHTML['first_do'][$first_do] = array_merge(array_values($videoBtnHTML['first_do'][$first_do]), [$form_input_2]);
                }
                if (isset($_POST['form_id-3'])) {
                    $form_input_3 = $_POST['form_id-3'];
                    $videoBtnHTML['first_do'][$first_do] = array_merge(array_values($videoBtnHTML['first_do'][$first_do]), [$form_input_3]);
                }
                break;
            }
            case "list": {
                $videoBtnHTML['first_do']['list'] = true;
                break;
            }
            case "link": {
                if (isset($_POST['link-1'])) {
                    $videoBtnHTML['first_do']['link'] = $_POST['link-1'];
                }
                break;
            }
            case "next_lesson": {
                $videoBtnHTML['first_do']['next_lesson'] = true;
                break;
            }
        }
        if (isset($button_text)) {
            switch ($_POST['second_do']) {
                case "pay_form":
                case "form": {
                    if (isset($_POST['form_id-4'])) {
                        $form_input_1 = $_POST['form_id-4'];
                        $videoBtnHTML['second_do'][$second_do] = [$form_input_1];
                    }
                    if (isset($_POST['form_id-5'])) {
                        $form_input_2 = $_POST['form_id-5'];
                        $videoBtnHTML['second_do'][$second_do] = array_merge(array_values($videoBtnHTML['second_do'][$second_do]), [$form_input_2]);
                    }
                    if (isset($_POST['form_id-6'])) {
                        $form_input_3 = $_POST['form_id-6'];
                        $videoBtnHTML['second_do'][$second_do] = array_merge(array_values($videoBtnHTML['second_do'][$second_do]), [$form_input_3]);
                    }
                    break;
                }
                case "link": {
                    if (isset($_POST['link-2'])) {
                        $videoBtnHTML['second_do']['link'] = $_POST['link-2'];
                    }
                    break;
                }
                case 'list':
                {
                    $videoBtnHTML['second_do']['list'] = true;
                    break;
                }
                case 'next_lesson': {
                    $videoBtnHTML['second_do']['next_lesson'] = true;
                    break;
                }
            }
        }
        $videoBtnHTMLResult = json_encode($videoBtnHTML);
        $this->m->db->execute("UPDATE `funnel_content` SET `popup` = '$videoBtnHTMLResult', `button_text` = '$button_text'  WHERE id = '$id_video'");
        return True;
    }

    public function selectCourse()
    {
        $id = $_POST['id'];
        $course_id = $_POST['course_id'];
        $course = $this->m->db->query("SELECT * from course WHERE `id` = '$course_id'");
        $funnel = $this->m->db->query("SELECT * from funnel WHERE `id` = '$id'");
        if (!$this->isUser($course[0]['author_id'])) return False;
        if (!$this->isUser($funnel[0]['author_id'])) return False;
        $this->m->db->execute("UPDATE `funnel` SET `course_id` = '$course_id' WHERE `id` = '$id'");
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
				    window.history.go(-1)
				</script>
			</body>
			</html>';
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}
