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

            $res = $this->funnel->Get();
            $count_video = count($this->funnel_content->Get(["funnel_id" => $res[0]['id']])) + 1;

//          Проверка на юзера
            if (!$this->isUser($res[0]['author_id'])) return False;
            if (!$this->tariff_class->GetTariff($res[0]['author_id'])) return False;
//          Проверка на юзера

            $name_video = hash('md5', $_FILES['video_uploader']['name']);

            $path = $this->url_dir . "funnels/$item_id/{$count_video}_{$name_video}.mp4";

            $max_file_size = $this->CheckTariff()[0]['file_size'] * 1000 * 1000 * 1000;

            $files_size = $this->funnel_content->dir_size($this->url_dir);

            if ($_FILES['video_uploader']['size'] + $files_size > $max_file_size + $this->CheckTariff()[0]['memory_add']) {
                return False;
            }

            move_uploaded_file($_FILES['video_uploader']['tmp_name'], $path);

            chmod($path, 0777);

            $data = [
                "funnel_id" => $item_id,
                "name" => NULL,
                "description" => NULL,
                "video" => $path,
                "query_id" => $count_video
            ];

            $this->funnel_content->InsertQuery("funnel_content", $data);

            $this->local_get_content();

            return true;
        }

        public function AddView()
        {
             $this->funnel->AddView($_SESSION['item_id'], $this->funnel->GetView($_SESSION['item_id']));
             return true;
        }

        public function DeleteVideo()
        {
            $item_id = $_SESSION['item_id'];
//          Проверка на юзера

            $funnel = $this->funnel_content->GetVideoAndAuthorId($item_id);

            if (!$this->isUser($funnel[0]['author_id'])) return False;
//          Проверка на юзера
            unlink($funnel[0]['video']);

            $this->funnel_content->DeleteQuery("funnel_content", [$item_id]);

            $this->local_get_content();

            return True;
        }

        public function RenameVideo() {
            $item_id = $_SESSION['item_id'];

            $funnelContent = $this->funnel_content->Get();

            $res = $this->funnel->Get(['id' => $funnelContent[0]['funnel_id']]);

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
                $change__button = $button_text;
            } else {
                if (strlen($_POST['button_text']) == 0) {
                    $change__button = NULL;
                } else {
                    $change__button = $funnelContent[0]['button_text'];
                }
            }

            if (isset($_POST['disabled__transition'])) {
                $disabled__transition = 1;
            } else {
                $disabled__transition = 0;
            }

            $data = [
                "name" => $name,
                "description" => $description,
                "button_text" => $change__button,
                "disabled__transition" => $disabled__transition
            ];

            $this->funnel_content->UpdateQuery("funnel_content", $data, "WHERE id = {$item_id}");

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

            $funnel = $this->funnel_content->GetForChangeVideo($uid);

//          Проверка на юзера
            if (!$this->isUser($funnel[0]['author_id'])) return False;
//          Проверка на юзера

            $name_video = hash('md5', $_FILES['video_change']['name']);

            $path = $this->url_dir . 'funnels/' . $funnel[0]['funnel_id']. "/$name_video.mp4";

            if (file_exists($funnel[0]['video'])) unlink($funnel[0]['video']);

            move_uploaded_file($_FILES['video_change']['tmp_name'], $path);

            $this->funnel_content->UpdateQuery("funnel_content", ["video" => $path], "WHERE id = {$uid}");

            $this->local_get_content();

            return true;
        }

        public function CreateFunnel () {
            $uid = $_SESSION['user']['id'];

            if (!$this->tariff_class->GetTariff($uid)) {
                header('Location: /Tariff-absent');
                return false;
            };

            $data = [
                "author_id" => $uid,
                "name" => "Новая воронка",
                "description" => "Описание",
                "price" => 0
            ];

            $this->funnel->InsertQuery("funnel", $data);

            $funnel = $this->funnel->GetLast($uid);

            mkdir($this->url_dir ."/funnels/" . $funnel[0]['id']);

            chmod($this->url_dir ."funnels/" . $funnel[0]['id'], 0777);

            header('Location: /Funnel');

            return True;
        }

        public function DeleteFunnel () {
            $item_id = $_SESSION['item_id'];

            if (!$this->tariff_class->GetTariff($_SESSION['user']['id'])) return False;

//          Проверка на юзера

            $project = $this->funnel->Get();
            if (!$this->isUser($project[0]['author_id'])) return False;

//          Проверка на юзера

            $this->funnel->DeleteQuery("funnel", [$item_id]);

            rmdir($this->url_dir . "/funnels/$item_id/");

            $this->local_get_content();

            return True;
        }

        public function RenameFunnel()
        {
            $item_id = $_SESSION['item_id'];

            $res = $this->funnel->Get();

            if (!$this->isUser($res[0]['author_id'])) return False;

            if(isset($_POST['title'])) {

                $title = $_POST['title'];

                $this->funnel->UpdateQuery("funnel", ["name" => $title], "WHERE id = '$item_id'");
            }

            $this->local_get_content();

            return True;
        }

        public function CreatePopupSettings()
        {
            $id_video = $_SESSION['item_id'];

            $funnel_content = $this->funnel_content->Get();

            $funnel = $this->funnel->Get(["id" => $funnel_content[0]['funnel_id']]);

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

        public function PopupSettings() {
            $res = $this->funnel_content->Get();

//          Проверка на юзера

            $funnel = $this->funnel->Get(["id" => $res[0]['funnel_id']]);
            if (!$this->isUser($funnel[0]['author_id'])) return False;

//          Проверка на юзера

            $popup_settings = $this->CreatePopupSettings();

            $videoBtnHTMLResult = json_encode($popup_settings['json'], JSON_UNESCAPED_UNICODE);

            $this->funnel_content->UpdateQuery("funnel_content", ["popup" => $videoBtnHTMLResult, "button_text" => $popup_settings['button_standart']], "WHERE id = {$_POST['item_id']}");

            $this->local_get_content();

            return True;
        }

        public function CreateMainSettings()
        {
            $funnelSettings = [];
            $funnelSettings['desc__font'] = (string) $_POST['desc__font'];
            $funnelSettings['title__font'] = (string) $_POST['title__font'];
            $funnelSettings['desc__size'] = (string) $_POST['desc__size'];
            $funnelSettings['title__size'] = (string) $_POST['title__size'];
            $funnelSettings['button__style-color'] = (string) $_POST['button__style-color'];
            $funnelSettings['button__style-style'] = (string) $_POST['button__style-style'];
            $funnelSettings['number__style'] = (string) $_POST['number-style'];
            $funnelSettings['number__color'] = (string) $_POST['number-color'];

            return $funnelSettings;
        }

        public function MainSettings()
        {
            $check_user = $this->funnel->Get(["id" => $_POST['id_item']]);

            if (!$this->isUser($check_user[0]['author_id'])) return False;

            $main__settings = json_encode($this->CreateMainSettings(), JSON_UNESCAPED_UNICODE);

            if (isset($_POST['head__settings'])) {
                $this->funnel->UpdateQuery("funnel", ["head__settings" => $_POST['head__settings']], "WHERE id = {$_POST['id_item']}");
            }

            $this->funnel->UpdateQuery("funnel", ["style_settings" => $main__settings], "WHERE id = {$_POST['id_item']}");

            $this->local_get_content();

            return True;
        }

        public function GetMainSettings()
        {
            print_r($this->funnel->GetStyleSettings());
            return True;
        }

        public function SelectCourse()
        {
            $id = $_SESSION['item_id'];
            $course_id = $_POST['course_id'];

            $funnel = $this->funnel->Get();
            $course = $this->course->Get(["id" => $course_id]);

            if (!$this->isUser($course[0]['author_id'])) return False;
            if (!$this->isUser($funnel[0]['author_id'])) return False;

            $this->funnel->UpdateQuery("funnel", ["course_id" => $course_id], "WHERE `id` = $id");

            header("Location: /Funnel");

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
