<?php
    class FunnelController extends ACoreCreator {

        private function isUser($checkId)
        {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function AddVideo() {
            if (is_null($_FILES['video_uploader'])) {
                return False;
            }
            $uid = $_SESSION['item_id'];
            $res = $this->m->db->query("SELECT * FROM `funnel` WHERE id = '$uid'");
            $count_video = count($this->m->db->query("SELECT * FROM `funnel_content` WHERE funnel_id = ". $res[0]['id'])) + 1;

    //        if (!$this->isUser($res[0]['author_id'])) return False;

            $path = $this->url_dir . "/funnels/$uid"."_".$res[0]['name']."/$count_video"."_".$_FILES['video_uploader']['name'];

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], $path);

            $this->m->db->execute("INSERT INTO funnel_content (`funnel_id`, `name`, `description`, `video`, `query_id`) VALUES ($uid,'Укажите заголовок','Укажите описание', '$path', $count_video)");

            return true;
        }

        public function DeleteVideo()
        {
            $item_id = $_SESSION['item_id'];
            $path_in_files = $this->m->db->query("SELECT `video` FROM `funnel_content` WHERE id = '$item_id'");

//            $author_id = $this->m->db->query("SELECT funnel.author_id FROM `funnel_content` AS content WHERE INNER JOIN `funnel` AS funnel ON (funnel.id = content.funnel_id AND content.id = '$item_id')");
//            if (!$this->isUser($author_id)) return False;

            $this->m->db->execute("DELETE FROM `funnel_content` WHERE `id` = '$item_id'");
            unlink($path_in_files[0]['video']);
            return True;
        }

        public function RenameVideo() {
            $item_id = $_SESSION['item_id'];
            $funnelContent = $this->m->db->query("SELECT * FROM `funnel_content` WHERE id = '$item_id'");
            $res = $this->m->db->query("SELECT * FROM `funnel` WHERE id = ".$funnelContent[0]['funnel_id']);
            if (!$this->isUser($res[0]['author_id'])) return False;
            $name = $_POST['name'];
            $description = $_POST['description'];
            $button_text = $_POST['button_text'];
            $this->m->db->execute("UPDATE `funnel_content` SET `name` = '$name', `description` = '$description', `button_text` = '$button_text' WHERE `id` = '$item_id'");
            return True;
        }

        public function CreateFunnel () {
            $uid = $_SESSION['user']['id'];

            $name = '_Новая воронка';

            $this->m->db->execute("INSERT INTO funnel (`author_id`, `name`, `description`, `price`) VALUES ('$uid', 'Новая воронка', 'Описание' , 0)");

            $funnel = $this->m->db->query("SELECT * FROM funnel WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            mkdir($this->url_dir ."/funnels/" . $funnel[0]['id']. '_' .$funnel[0]['name']);
            header('Location: /Funnel');
            return True;
        }

        public function DeleteFunnel () {
            $item_id = $_SESSION['item_id'];
            $project = $this->m->db->query("SELECT * FROM funnel WHERE id = '$item_id' LIMIT 1");

            if (!$this->isUser($project[0]['author_id'])) return False;

            $this->m->db->execute("DELETE FROM funnel WHERE id = '$item_id'");

            rmdir($this->url_dir . "/funnels/$item_id" . "_" . $project[0]['name']);

            return True;
        }

        public function RenameFunnel()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->m->db->query("SELECT * FROM funnel WHERE id = '$item_id'");

            if (!$this->isUser($res[0]['author_id'])) return False;

            if(isset($_POST['title'])) {

                $last_name = $res[0]['name'];

                $name = $_POST['title'];

                rename("./uploads/funnel/$item_id". "_" ."$last_name", "./uploads/funnel/$item_id" . "_" . "$name");

                $paths = $this->m->db->query("SELECT * FROM funnel_content WHERE funnel_id = '$item_id'");

                $this->m->db->execute("UPDATE funnel SET `name` = '$name' WHERE id = '$item_id'");

                foreach ($paths as $path) {
                    $id = $path['id'];

                    $pages = explode("/", $path['video']);

                    $pages[3] = $item_id . "_" . $name;

                    $changed = implode("/", $pages);

                    $this->m->db->execute("UPDATE `funnel_content` SET `video` = '$changed' WHERE id = '$id'");

                }
            }
            return True;
        }

        public function PopupSettings() {
            //Форма
            $id_video = $_POST['item_id'];
            $funnel_content = $this->m->db->query("SELECT * FROM funnel_content WHERE id = '$id_video'");
            $funnel = $this->m->db->query("SELECT * FROM funnel WHERE id = ". $funnel_content[0]['funnel_id']);
//            if (!$this->isUser($funnel[0]['author_id'])) return False;

            $videoBtnHTML = [];
            $first_do = $_POST['first_do'];
            $second_do = $_POST['second_do'];
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
            switch ($_POST['second_do']) {
                case "pay_form": {
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
                        $vid1oBtnHTML['second_do']['link'] = $_POST['link-2'];
                    }
                    break;
                }
                case "file": {
                    if(!$_FILES['file']['name']){
                        $file_name = uniqid('', true) .".jpg";
                    } else {
                        $file_name = $_FILES['file']['name'];
                    }

                    $file = $this->url_dir . "/files/" . $funnel[0]['id'] . '_' .$funnel[0]['name'] . "/" . $file_name;

                    move_uploaded_file($_FILES['file']['tmp_name'], $file);

                    $videoBtnHTML['second_do']['file'] = $file;
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
                case '': {
                    $videoBtnHTML['second_do']['file'] = $_POST['file'];
                }
            }
            $videoBtnHTMLResult = json_encode($videoBtnHTML, JSON_UNESCAPED_UNICODE);
            $this->m->db->execute("UPDATE `funnel_content` SET `popup` = '$videoBtnHTMLResult' WHERE id = '$id_video'");
            return True;
        }

        public function SelectCourse()
        {
            $id = $_SESSION['item_id'];
            $course_id = $_POST['course_id'];
            $course = $this->m->db->query("SELECT * from course WHERE `id` = '$course_id'");
            $funnel = $this->m->db->query("SELECT * from funnel WHERE `id` = '$id'");
            if (!$this->isUser($course[0]['author_id'])) return False;
            if (!$this->isUser($funnel[0]['author_id'])) return False;
            $this->m->db->execute("UPDATE `funnel` SET `course_id` = '$course_id' WHERE `id` = '$id'");
            return True;
        }

        function get_content()
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
        }
    }
