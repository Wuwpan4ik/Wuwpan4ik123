<?php
    class MailingController extends ACoreCreator
    {
        use SendEmail;

        public function CreateAndEdit()
        {
            $data_get = [];
            foreach (array_keys($_POST) as $key) {
                $data_get[$key] = $_POST[$key];
            }
            $data_get['user_id'] = $_SESSION['user']['id'];
			if (empty($data_get['date_send'])) {
				$data_get['date_send'] = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
			}
	        if (empty($data_get['time_send'])) {
		        $data_get['time_send'] = "00:00:00";
			}
			
			$time = strtotime($data_get['date_send'] . ' ' . $data_get['time_send']);
			
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
	        $_SESSION['error'] = $data_get;
//          Работа с файликов

            $body = include "./template/templates_email/mail.php";

            if (!empty($data_get['id'])) {
                $this->Delete($data_get['id']);
            }
			
            $this->Create($data_get);
			if (empty($data_get['once_email'])) {
				if ($data_get['indexs'] == 3) {
					$users = $this->mailing->GetUsers($data_get['product']);
				} else {
					$users = $this->mailing->GetUsersByIndexs($data_get['indexs'], $data_get['product']);
				}
			} else {
				$users = $data_get['once_email'];
			}
	        $mail_id = $this->mailing->ClearQuery("SELECT * FROM mailing WHERE user_id = {$_SESSION['user']['id']} ORDER BY id DESC LIMIT 1")[0]['id'];
	        foreach ($users as $user) {
                $data = [
                    "foreign_id_a" => $mail_id,
                    "foreign_id_b" => $data_get['user_id'],
                    'from_name' => "Course Creator IO",
                    "from" => "{$this->ourEmail}",
                    "to" => "{$user['email']}",
                    "sender" => "{$this->ourEmail}",
                    "subject" => "Вам пришло письмо от создателя курса!",
                    "content" => "$body"
                ];

                if (!$time) {
                    $data['is_send_now'] = 1;
                } else {
                    $data['date_queued'] = $time - 10800;
                }

                $this->SendEmail(
                    $data
                );
            }
            $this->get_content();
        }

        public function Create($data)
        {
			$this->mailing->Create($data);
        }

        public function Delete($id = null)
        {
            $mail_id = is_null($id) ? $_SESSION['item_id'] : $id;
            $this->mailing->DeleteQuery("mailing", ["id" => $mail_id]);
            $this->EmailQueueDeleteCall($mail_id);
            $this->get_content();
        }

        public function get_content()
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }