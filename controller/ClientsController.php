<?php

    if (!class_exists('PHPMailer\PHPMailer\Exception'))
    {
    require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '/vendor/phpmailer/phpmailer/src/SMTP.php';
    require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    }

    class ClientsController extends ACoreCreator {
        private $password;
        private $name;
        private $phone;

        private function GenerateRandomPassword ($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
            $str = '';
            $max = strlen($keyspace) - 1;
            if ($max < 1) {
                throw new Exception('$keyspace must be at least two characters long');
            }
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[rand(0, $max)];
            }
            return $str;
        }


        private function GetClient($course_id) {
            return $this->m->db->query("SELECT * FROM `clients` WHERE `course_id` = '$course_id' AND `email` = '$this->email'");
        }

        private function GetPriceOfCourse($course_id) {
            return $this->m->db->query("SELECT * FROM `course` WHERE id = '$course_id'");
        }

        private function GetPriceOfVideo($video_id) {
            return $this->m->db->query("SELECT * FROM `course_content` WHERE id = '$video_id'");
        }

        public function InsertToTable($creator_id, $course_id, $buy_progress, $course_price) {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $this->m->db->execute("INSERT INTO `clients` (`first_name`, `email`, `tel`, `creator_id`, `course_id`, `give_money`, `buy_progress`, `achivment_date`) VALUES ('$this->name', '$this->email', '$this->phone', '$creator_id', '$course_id', '$course_price', '$buy_progress', '$current_date')");
            return true;
        }

        public function RequestValidate()
        {
            $this->email = $_POST['email'];
            if (isset($_POST['name'])) {
                $this->name = $_POST['name'];
//                if (!preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$this->name)) {
//                    return false;
//                }
            }
//            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
//                return false;
//            }

            if (isset($_POST['phone'])) {
                $this->phone = $_POST['phone'];
            } else {
                $this->phone = null;
            }

            return True;
        }

        public function SendEmail ($title, $body) {

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->CharSet = "UTF-8";
                $mail->SMTPAuth   = true;
                $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

                // Настройки вашей почты
                $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
                $mail->Username   = $this->ourEmail; // Логин на почте
                $mail->Password   = $this->ourPassword; // Пароль на почте
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
                $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
                );
                $mail->setFrom($this->ourEmail, $this->ourNickName); // Адрес самой почты и имя отправителя

                // Получатель письма
                $mail->addAddress($this->email);

                $mail->isHTML(true);
                $mail->Subject = $title;
                $mail->Body = $body;

                if ($mail->send()) {$result = "success";}
                else {$result = "allGood";}

            } catch (Exception $e) {
                $result = $mail->ErrorInfo;
                $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
            }
            echo $result;
        }

        public function AddApplication() {
            if (!$this->RequestValidate()) return false;
            $buy_progress = include './settings/buy_progress.php';
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            $comment = 'Заявка';
            $client = $this->GetClient($course_id);
            if (count($client) == 1){
                if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]' WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
                }
            } else {
                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], 0);
            }
            return true;
        }

//      Без какой либо зависимости, что человек уже купил видео курса (покупает по полной)
        public function BuyCourse() {
            if (!$this->RequestValidate()) return false;

            $buy_progress = include './settings/buy_progress.php';
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            $comment = 'Купил курс';
            $client = $this->GetClient($course_id);
            $give_money = $client[0]['give_money'] + $this->GetPriceOfCourse($course_id)[0]['price'];

//          Добавление Clients
            if (count($client) == 1){
                if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money', `first_buy` = 0 WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");                }
            } else {
                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);
            }
//          Добавление User
            $_SESSION['error'] = $this->email;
            if (count($this->m->getUserByEmail($this->email)) != 1) {

                $title = "Регистрация аккаунта";
                $this->password = $this->GenerateRandomPassword(12);
                $body = "Ваш аккаунт на <a href=\"/UserLogin\">Course Creator</a><br>Почта: $this->email<br>Пароль:$this->password";
                $this->SendEmail($title, $body);

                $this->m->db->execute("INSERT INTO `user` (`email`, `password`, `is_creator`) VALUES ('$this->email', '$this->password', 0)");

                if (isset($this->name)) {
                    $this->m->db->execute("INSERT INTO `user` (`first_name`) VALUES ('$this->name') WHERE `email` = '$this->email'");
                }

                if (isset($this->phone)) {
                    $this->m->db->execute("INSERT INTO `user` (`telephone`) VALUES ('$this->phone') WHERE `email` = '$this->email'");
                }
                $res = $this->m->getUserByEmail($this->email);
                $_SESSION["user"] = [
                    'id' => $res[0]['id'],
                    'email' => $res[0]['email'],
                    'is_creator' => 0
                ];
            }
//          Добавление Purchase
            $purchase = $this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id']);
            if (isset($purchase) && count($purchase) == 1) {
                $purchase_info = json_decode($purchase[0]['purchase'], true);
                if (!in_array($course_id, $purchase_info['course_id'])) {
                    array_push($purchase_info['course_id'], $course_id);
                    $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_info) . "' WHERE user_id = " . $_SESSION['user']['id']);
                }
            } else {
                $user_id = $_SESSION['user']['id'];
                $purchase_text = '{"course_id":["'.$course_id.'"], "video_id":[]}';
                $this->m->db->execute("INSERT INTO `purchase` (`user_id`, `purchase`) VALUES ('$user_id', '$purchase_text')");
            }
            $this->addNotifications("item-like", 'Вы купили курс', '/img/Notification/message.png', $_SESSION['user']['id']);
            return true;
        }

        public function BuyVideo() {
            if (!$this->RequestValidate()) return false;
            $buy_progress = include './settings/buy_progress.php';
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            $course__real_id = $this->m->db->query("SELECT course_id FROM course_content WHERE id = '$course_id'")[0]['course_id'];
            $comment = 'Купил видео';
            $client = $this->GetClient($course__real_id);
            $give_money = $client[0]['give_money'] + $this->GetPriceOfVideo($course_id)[0]['price'];
//          Добавление Clients
            if (count($client) == 1){
                if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money', `first_buy` = 0 WHERE `creator_id` = '$creator_id' AND `course_id` = '$course__real_id' AND `email` = '$this->email'");
                }
            } else {
                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);
            }
//          Добавление User
            if (count($this->m->getUserByEmail($this->email)) != 1) {
                $title = "Регистрация аккаунта";
                $this->password = $this->GenerateRandomPassword(12);
                $body = "Ваш аккаунт на <a href=\"/https://course-creator.io/UserLogin\">Course Creator</a><br>Почта: $this->email<br>Пароль:$this->password";
                $this->SendEmail($title, $body);

                $this->m->db->execute("INSERT INTO `user` (`email`, `password`, `is_creator`) VALUES ('$this->email', '$this->password', 0)");

                if (isset($this->name)) {
                    $this->m->db->execute("INSERT INTO `user` (`first_name`) VALUES ('$this->name') WHERE `email` = '$this->email'");
                }

                if (isset($this->phone)) {
                    $this->m->db->execute("INSERT INTO `user` (`telephone`) VALUES ('$this->phone') WHERE `email` = '$this->email'");
                }
                $res = $this->m->getUserByEmail($this->email);
                $_SESSION["user"] = [
                    'id' => $res[0]['id'],
                    'email' => $res[0]['email'],
                    'is_creator' => 0
                ];
            }
//          Добавление Purchase
            $purchase = $this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id']);
            if (isset($purchase) && count($purchase) == 1) {
                $purchase_info = json_decode($purchase[0]['purchase'], true);
                if (!in_array($course_id, $purchase_info['video_id'])) {
                    array_push($purchase_info['video_id'], $course_id);
                    $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_info) . "' WHERE user_id = " . $_SESSION['user']['id']);
                }
            } else {
                $user_id = $_SESSION['user']['id'];
                $purchase_text = '{"course_id":[], "video_id":['.$course_id.']}';
                $this->m->db->execute("INSERT INTO `purchase` (`user_id`, `purchase`) VALUES ('$user_id', '$purchase_text')");
            }

//          Проверка покупки всех видео
            $purchase_video = json_decode($this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id'])[0]['purchase'], true);
            $id = $this->m->db->query("SELECT course_content.course_id FROM course_content WHERE id = '$course_id'")[0]['course_id'];
            $course_list = explode(',', $this->m->db->query("SELECT GROUP_CONCAT(`id`) FROM `course_content` WHERE course_id = '$id'")[0]['GROUP_CONCAT(`id`)']);
            foreach ($course_list as $item) {
                if (!in_array($item, $purchase_video['video_id'])) {
                    return true;
                }
            }
            foreach ($purchase_video['video_id'] as $key=>$item) {
                if (in_array($item, $course_list)) unset($purchase_video['video_id'][$key]);
            }
            array_push($purchase_video['course_id'], $id);
            $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_video) . "' WHERE user_id = " . $_SESSION['user']['id']);
            return true;
        }

        public function Delete() {
            $item_id = $_SESSION['item_id'];
            $query = $this->m->db->query("SELECT * FROM `clients` WHERE `creator_id` = " . $_SESSION['user']['id'] . " AND `id` = '$item_id'");
            if (count($query) != 1) {
                return false;
            }
            $this->m->db->execute("DELETE FROM `clients` WHERE `id` = '$item_id'");
            return true;
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
                        window.location.replace("/");
                    </script>
                </body>
                </html>';
        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }