<?php
    class MailingController extends ACoreCreator
    {
        public function CreateAndEdit()
        {
            $data_get = [];
            foreach (array_keys($_POST) as $key) {
                $data_get[$key] = $_POST[$key];
            }
            $data_get['user_id'] = $_SESSION['user']['id'];
            unset($data_get['mytabs']);
            unset($data_get['file']);

//          Кодировка кнопок
            $buttons = [];
            for ($i = 1; $i < count($data_get); $i+= 1) {
                if (isset($data_get["{$i}_button"]) && isset($data_get["{$i}_link"])) {
                    $buttons[$data_get["{$i}_button"]] = $data_get["{$i}_link"];
                    unset($data_get["{$i}_button"]);
                    unset($data_get["{$i}_link"]);
                } else {
                    break;
                }
            }
            $data_get['buttons'] = json_encode($buttons, JSON_UNESCAPED_UNICODE);
//          Кодировка кнопок

//          Работа с файликов
            $dir_path = "./uploads/users/" . $_SESSION['user']['id'] . "/mailing";
            if (!is_dir($dir_path)) {
                mkdir($dir_path);
                chmod($dir_path, 0777);
            }

            if ($_FILES['file']['size'] != 0) {
                $extension = pathinfo($_FILES['file']['name'])['extension'];
                $file_path = $dir_path . "/1.$extension";
                move_uploaded_file($_FILES['file']['tmp_name'], "./" . $file_path);
                $data_get['file'] = $dir_path . "/1.$extension";
            }
//          Работа с файликов

            if (!empty($data_get['id'])) {
                $this->Edit($data_get);
            } else {
                $this->Create($data_get);
            }
            $this->get_content();
        }

        public function Create($data)
        {
            $this->mailing->InsertQuery('mailing', $data);
        }

        public function Edit($data)
        {
            $this->mailing->UpdateQuery('mailing', $data, "WHERE id = {$data['id']}");
        }

        public function Delete()
        {
            $this->mailing->DeleteQuery("mailing", $_SESSION['item_id']);
        }

        public function get_content()
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }