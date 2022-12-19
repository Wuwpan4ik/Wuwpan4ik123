<?php
    class FunnelController extends ACoreCreator {

        private function isUser($checkId)
        {
            return $_SESSION['user']['id'] == $checkId;
        }

        public function AddVideo() {
            if ($_FILES['video_uploader']['size'] == 0)
            {
                return False;
            }
            $item_id = $_SESSION['item_id'];
            $res = $this->m->db->query("SELECT * FROM `funnel` WHERE id = '$item_id'");
            $count_video = count($this->m->db->query("SELECT * FROM `funnel_content` WHERE funnel_id = ". $res[0]['id'])) + 1;

    //        if (!$this->isUser($res[0]['author_id'])) return False;

            $path = $this->url_dir . "/funnels/$item_id"."/$count_video"."_".$_FILES['video_uploader']['name'];

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], $path);

            $this->m->db->execute("INSERT INTO funnel_content (`funnel_id`, `name`, `description`, `video`, `query_id`) VALUES ($item_id,'Укажите заголовок','Укажите описание', '$path', $count_video)");

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

            if (isset($_POST['name']) && strlen($_POST['name']) > 0) {
                $name = $_POST['name'];
            } else {
                $name = $funnelContent[0]['name'];
            }

            if (isset($_POST['description']) && strlen($_POST['description']) > 0) {
                $description = $_POST['description'];
            } else {
                $description = $funnelContent[0]['description'];
            }

            if (isset($_POST['price']) && strlen($_POST['price']) > 0) {
                $price = $_POST['price'];
            } else {
                $price = $funnelContent[0]['price'];
            }

            if (isset($_POST['button_text']) && strlen($_POST['button_text']) > 0) {
                $button_text = $_POST['button_text'];
                $change__button = "`button_text` = '$button_text'";
            } else {
                if (strlen($_POST['button_text']) == 0) {
                    $change__button = "`button_text` = NULL";
                } else {
                    $change__button = "`button_text` = " . $funnelContent[0]['button_text'];
                }
            }

            $this->m->db->execute("UPDATE `funnel_content` SET `name` = '$name', `price` = '$price', `description` = '$description', $change__button WHERE `id` = '$item_id'");

            return True;
        }

        public function ChangeVideo()
        {
            if ($_FILES['video_change']['size'] == 0)
            {
                return False;
            }

            $uid = $_SESSION['item_id'];
            $res = $this->m->db->query("SELECT * FROM `funnel_content` WHERE id = '$uid'");
            $funnel = $this->m->db->query("SELECT * FROM `funnel` WHERE id = " . $res[0]['funnel_id']);
            $count_video = $this->m->db->query("SELECT `query_id` FROM `funnel_content` WHERE id = ". $uid)[0]['query_id'];

            if (!$this->isUser($funnel[0]['author_id'])) return False;

            unlink($res[0]['video']);

            $path = $this->url_dir . 'funnels/' . $res[0]['funnel_id']. "/$count_video" ."_" . $_FILES['video_change']['name'];

            move_uploaded_file($_FILES['video_change']['tmp_name'], $path);

            $this->m->db->execute("UPDATE funnel_content SET `video` = '$path' WHERE id = " . $uid);

            return true;
        }

        public function CreateFunnel () {
            $uid = $_SESSION['user']['id'];

            $this->m->db->execute("INSERT INTO funnel (`author_id`, `name`, `description`, `price`) VALUES ('$uid', 'Новая воронка', 'Описание' , 0)");

            $funnel = $this->m->db->query("SELECT * FROM funnel WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            mkdir($this->url_dir ."/funnels/" . $funnel[0]['id']);

            return True;
        }

        public function DeleteFunnel () {
            $item_id = $_SESSION['item_id'];

            $project = $this->m->db->query("SELECT * FROM funnel WHERE id = '$item_id' LIMIT 1");

            if (!$this->isUser($project[0]['author_id'])) return False;

            $this->m->db->execute("DELETE FROM funnel WHERE id = '$item_id'");

            rmdir($this->url_dir . "/funnels/$item_id");

            return True;
        }

        public function RenameFunnel()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->m->db->query("SELECT * FROM funnel WHERE id = '$item_id'");

            if (!$this->isUser($res[0]['author_id'])) return False;

            if(isset($_POST['title'])) {

                $name = $_POST['title'];

                $this->m->db->execute("UPDATE funnel SET `name` = '$name' WHERE id = '$item_id'");
            }
            return True;
        }

        public function PopupSettings() {
            //Форма
            $save = $_POST['save'] ?? null;
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
                    $videoBtnHTML['first_do']['course_id'] = $_POST['course_list'];
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
            if (strlen($_POST['button__send']) > 0) {
                $videoBtnHTML['button_text'] = $_POST['button__send'];
            } else {
                $videoBtnHTML['button_text'] = "Отправить";
            }
            if (strlen($_POST['form__title']) > 0) {
                $videoBtnHTML['form__title'] = $_POST['form__title'];
            } else {
                $videoBtnHTML['form__title'] = "Заголовок";
            }
            if (strlen($_POST['form__desc']) > 0) {
                $videoBtnHTML['form__desc'] = $_POST['form__desc'];
            } else {
                $videoBtnHTML['form__desc'] = "Описание";
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
                        $videoBtnHTML['second_do']['link'] = $_POST['link-2'];
                    }
                    if (isset($_POST['link-2'])) {
                        $videoBtnHTML['second_do']['open_in_new'] = $_POST['open_new_window'];
                    }
                    break;
                }
                case "file": {
                    if(!$_FILES['file']['name']){
                        $file_name = uniqid('', true) .".jpg";
                    } else {
                        $file_name = $_FILES['file']['name'];
                    }

                    $file = $this->url_dir . "/files/" . $funnel[0]['id'] . '_' . $file_name;

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
//          // Если нет значения, то добавляет к кнопке "Посмотреть"
            $button__standart = '';
            if (strlen($funnel_content[0]['button_text']) == 0) {
                $button__standart = ', `button_text` = "Посмотреть"';
            }

            $videoBtnHTMLResult = json_encode($videoBtnHTML, JSON_UNESCAPED_UNICODE);
            if ($save) {
                $this->m->db->execute("UPDATE `funnel_content` SET `popup` = '$videoBtnHTMLResult'$button__standart WHERE id = '$id_video'");
            } else {
                echo "Есть различия";
            }
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
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        function obr()
        {
        }
    }
