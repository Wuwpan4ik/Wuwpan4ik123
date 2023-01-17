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

//          Проверка на юзера
            if (!$this->isUser($res[0]['author_id'])) return False;
//          Проверка на юзера

            $name_video = hash('md5', $_FILES['video_uploader']['name']);

            $path = $this->url_dir . "funnels/$item_id/{$count_video}_{$name_video}.mp4";

            $max_file_size = $this->CheckTariff()[0]['file_size'] * 1000 * 1000 * 1000;

            $files_size = $this->m->dir_size($this->url_dir);

            if ($_FILES['video_uploader']['size'] + $files_size > $max_file_size) {
                return False;
            }

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], $path);

            chmod($path, 0777);

            $this->m->db->execute("INSERT INTO funnel_content (`funnel_id`, `name`, `description`, `video`, `query_id`) VALUES ($item_id,NULL ,NULL, '$path', $count_video)");

            $this->local_get_content();

            return true;
        }

        public function AddView()
        {
             $this->m->AddView($_SESSION['item_id'], $this->m->GetView($_SESSION['item_id']));
             return true;
        }

        public function DeleteVideo()
        {
            $item_id = $_SESSION['item_id'];
//          Проверка на юзера

            $funnel = $this->m->db->query("SELECT funnel.author_id, funnel_content.video FROM `funnel_content` INNER JOIN `funnel` ON funnel.id = funnel_content.funnel_id WHERE funnel_content.id = $item_id");

            if (!$this->isUser($funnel[0]['author_id'])) return False;
//          Проверка на юзера

            $this->m->db->execute("DELETE FROM `funnel_content` WHERE `id` = '$item_id'");

            unlink($funnel[0]['video']);

            $this->local_get_content();

            return True;
        }

        public function RenameVideo() {
            $item_id = $_SESSION['item_id'];

            $funnelContent = $this->m->db->query("SELECT * FROM `funnel_content` WHERE id = '$item_id'");

            $res = $this->m->db->query("SELECT * FROM `funnel` WHERE id = ".$funnelContent[0]['funnel_id']);

//          Проверка на юзера
            if (!$this->isUser($res[0]['author_id'])) return False;
//          Проверка на юзера

            if (isset($_POST['name']) && strlen($_POST['name']) > 0) {
                $name = $_POST['name'];
            } else {
                $description = null;
            }

            if (isset($_POST['description']) && strlen($_POST['description']) > 0) {
                $description = $_POST['description'];
            } else {
                $description = null;
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

            $this->m->db->execute("UPDATE `funnel_content` SET `name` = '$name', `description` = '$description', $change__button WHERE `id` = '$item_id'");

            $this->local_get_content();

            return True;
        }

        public function ChangeVideo()
        {
            if ($_FILES['video_change']['size'] == 0)
            {
                return False;
            }

            $uid = $_SESSION['item_id'];

            $funnel = $this->m->db->query("SELECT funnel.author_id, funnel_content.funnel_id, funnel_content.video FROM `funnel_content` INNER JOIN `funnel` ON funnel.id = funnel_content.funnel_id WHERE funnel_content.id = '$uid'");

//          Проверка на юзера
            if (!$this->isUser($funnel[0]['author_id'])) return False;
//          Проверка на юзера

            $name_video = hash('md5', $_FILES['video_change']['name']);

            $path = $this->url_dir . 'funnels/' . $funnel[0]['funnel_id']. "/$name_video";

            if (file_exists($funnel[0]['video'])) unlink($funnel[0]['video']);

            move_uploaded_file($_FILES['video_change']['tmp_name'], $path);

            $this->m->db->execute("UPDATE funnel_content SET `video` = '$path' WHERE id = " . $uid);

            $this->local_get_content();

            return true;
        }

        public function CreateFunnel () {
            $uid = $_SESSION['user']['id'];

            $this->m->db->execute("INSERT INTO funnel (`author_id`, `name`, `description`, `price`) VALUES ('$uid', 'Новая воронка', 'Описание' , 0)");

            $funnel = $this->m->db->query("SELECT * FROM funnel WHERE author_id = '$uid'  ORDER BY ID DESC LIMIT 1");

            mkdir($this->url_dir ."/funnels/" . $funnel[0]['id']);

            chmod($this->url_dir ."funnels/" . $funnel[0]['id'], 0777);

            header('Location: /Funnel');

            return True;
        }

        public function DeleteFunnel () {
            $item_id = $_SESSION['item_id'];

//          Проверка на юзера
            $project = $this->m->db->query("SELECT * FROM funnel WHERE id = '$item_id' LIMIT 1");

            if (!$this->isUser($project[0]['author_id'])) return False;
//          Проверка на юзера

            $this->m->db->execute("DELETE FROM funnel WHERE id = '$item_id'");

            rmdir($this->url_dir . "/funnels/$item_id/");

            $this->local_get_content();

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

            $this->local_get_content();

            return True;
        }

        public function CreatePopupSettings()
        {
            $id_video = $_SESSION['item_id'];

            $funnel_content = $this->m->db->query("SELECT * FROM `funnel_content` WHERE `id` = $id_video");

            $funnel = $this->m->db->query("SELECT * FROM `funnel` WHERE `id` = {$funnel_content[0]['funnel_id']}");

            if (!$this->isUser($funnel[0]['author_id'])) return False;

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
                        $videoBtnHTML['first_do']['open_in_new'] = $_POST['open_new_window'];
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
            if (isset($_POST['second_do'])) {
                switch ($_POST['second_do']) {
                    case "pay_form":
                    {
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
                    case "link":
                    {
                        if (isset($_POST['link-2'])) {
                            $videoBtnHTML['second_do']['link'] = $_POST['link-2'];
                        }
                        if (isset($_POST['link-2'])) {
                            $videoBtnHTML['second_do']['open_in_new'] = $_POST['open_new_window'];
                        }
                        break;
                    }
                    case "file":
                    {
                        if (!$_FILES['file']['name']) {
                            $file_name = uniqid('', true) . ".jpg";
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
                    case 'next_lesson':
                    {
                        $videoBtnHTML['second_do']['next_lesson'] = true;
                        break;
                    }
                }
            }
            //          Если нет значения, то добавляет к кнопке "Посмотреть"
            if (strlen($funnel_content[0]['button_text']) == 0) {
                $button__standart = 'Посмотреть';
            } else {
                $button__standart = $funnel_content[0]['button_text'];
            }

            $this->local_get_content();

            return ['json' => $videoBtnHTML, 'button_standart' => $button__standart];
        }

        public function CreateMainSettings()
        {
            $funnelSettings = [];
            $funnelSettings['desc__font'] = $_POST['desc__font'];
            $funnelSettings['title__font'] = $_POST['title__font'];
            $funnelSettings['button__style-color'] = (string) $_POST['button__style-color'];
            $funnelSettings['button__style-style'] = (string) $_POST['button__style-style'];
            $funnelSettings['number__style'] = (string) $_POST['number-style'];
            $funnelSettings['number__color'] = (string) $_POST['number-color'];

            return ['json' => $funnelSettings];
        }

        public function MainSettings()
        {
            $check_user = $this->m->db->query("SELECT * FROM funnel WHERE id = {$_SESSION['item_id']}");

            if (!$this->isUser($check_user[0]['author_id'])) return False;

            $main_settings = $this->CreateMainSettings();

            $main__settingsResult = json_encode($main_settings['json'], JSON_UNESCAPED_UNICODE);

            $this->m->db->execute("UPDATE `funnel` SET `style_settings` = '$main__settingsResult' WHERE id = {$_SESSION['item_id']}");

            $this->local_get_content();
            return True;
        }

        public function GetMainSettings()
        {
            $result = $this->m->db->query("SELECT `style_settings` FROM funnel WHERE id = " . $_SESSION['item_id'])[0]['style_settings'];
            print_r($result);
            return True;
        }

        public function PopupSettings() {
            $res = $this->m->db->query("SELECT * FROM `funnel_content` WHERE id = {$_SESSION['item_id']}");

            $funnel = $this->m->db->query("SELECT * FROM `funnel` WHERE id = " . $res[0]['funnel_id']);

//          Проверка на юзера
            if (!$this->isUser($funnel[0]['author_id'])) return False;
//          Проверка на юзера

            $popup_settings = $this->CreatePopupSettings();

            $videoBtnHTMLResult = json_encode($popup_settings['json'], JSON_UNESCAPED_UNICODE);

            $this->m->db->execute("UPDATE `funnel_content` SET `popup` = '$videoBtnHTMLResult', `button_text` = '". $popup_settings['button_standart'] ."' WHERE id = {$_POST['item_id']}");

            $this->local_get_content();

            return True;
        }

        function get_content()
        {
        }

        function local_get_content()
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
