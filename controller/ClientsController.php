<?php

    class ClientsController extends ACoreCreator {
        private $password;
        private $name;
        private $phone;

        private function GetApplicationHtml () {
            return '<html lang="RU">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                        <div class="envelope-body" style="background:white;">
                            <div class="first_row">
                                <img style="width:100%;" src="https://course-creator.io/envelope-images/envelope-zayavka.jpg" alt="Добро пожаловать в Course Creator!">
                            </div>
                            <div class="second_row" style="padding:40px;">
                                <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
                                    Вам пришла заявка!
                                </h2>
                                <span style="color: rgba(0, 0, 0, 0.6);font-size:16px;font-weight:400;">
                                    Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                                </span>
                                <div class="info_account" style="display:flex;justify-content: space-between;gap: 20px;margin-top: 40px;flex-direction: column;">
                                    <div class="whereFrom" style="border-bottom: 1px dashed rgba(0, 0, 0, 0.2);border-top: 1px dashed rgba(0, 0, 0, 0.2);width:100%;padding-top:30px;padding-bottom: 30px;">
                                        <div class="from" style="margin-bottom: 20px;display:flex; justify-content: space-between;">
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                Откуда заявка:
                                            </span>
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                Воронка №1
                                            </span>
                                        </div>
                                        <div class="where" style="display:flex; justify-content: space-between">
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                На каком слайде:
                                            </span>
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                Слайд №3
                                            </span>
                                        </div>
                                    </div>
                                    <div class="whom" style="padding-bottom: 30px;border-bottom: 1px dashed rgba(0, 0, 0, 0.2);margin-bottom: 30px;">
                                        <div class="person" style="margin-bottom:20px;display:flex; justify-content: space-between">
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                Имя:
                                            </span>
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                Андрей
                                            </span>
                                        </div>
                                        <div class="email" style="margin-bottom:20px;display:flex; justify-content: space-between">
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                Email:
                                            </span>
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                adnrey@gmail/com
                                            </span>
                                        </div>
                                        <div class="phone" style="display:flex; justify-content: space-between">
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                Телефон:
                                            </span>
                                            <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                +380 66 768 87 34
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="link_account">
                                    <div class="first_row" style="width:100%">
                                        <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                            Смотрите другие заявки на сайте:
                                        </p>
                                        <div style="background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                            <a href="https://course-creator.io/" target="_blank" style="color: #8098AB;">
                                                https://course-creator.io/
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                            <div>
                                Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                            </div>
                        </div>
                    </body>
                    </html>';
        }

        private function GetRegistrationUserHtml ($email, $password) {
            return '<html lang="RU">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                        <div class="envelope-body" style="background:white;">
                            <div class="first_row">
                                <img style="width:100%;" src="https://course-creator.io/envelope-images/envelope-welcome.jpg" alt="Добро пожаловать в Course Creator!">
                            </div>
                            <div class="second_row" style="padding:40px;">
                                <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
                                    Вы приобрели курс!
                                </h2>
                                <span style="color: rgba(0, 0, 0, 0.6);font-size:16px;font-weight:400;">
                                    Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                                </span>
                                <div class="info_account" style="display:flex;justify-content: space-between;gap: 20px;margin-top: 40px;">
                                    <div class="first_row" style="width:50%">
                                        <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                            Ваш логин: 
                                        </p>
                                        <div style="color: #8098AB;background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                            ' . $email . '
                                        </div>
                                    </div>
                                    <div class="second_row" style="width:50%">
                                        <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                            Ваш пароль:
                                        </p>
                                        <div style="color: #8098AB;background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                            ' . $password . '
                                        </div>
                                    </div>
                                </div>
                                <div class="link_account" style="margin-top: 20px;">
                                    <a href="https://course-creator.io/UserLogin" target="_blank">
                                        <button style="width:100%; height:48px;border:none;font-size:16px;border-radius: 10px;background: linear-gradient(299.36deg, rgba(55, 101, 223, 0.93) 0%, rgba(100, 162, 255, 0.96) 100%);color:white;cursor: pointer;">
                                            Перейти в аккаунт
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                            <div>
                                Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                            </div>
                        </div>
                    </body>
                    </html>';
        }

        private function GetRegistrationClientHtml($name, $cost, $email)
        {
            return '<html lang="RU">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                            <div class="envelope-body" style="background:white;">
                                <div class="second_row" style="padding:40px;">
                                    <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
                                        Поздравляем, у вас купили курс!
                                    </h2>
                                    <span style="color: rgba(0, 0, 0, 0.6);font-size:16px;font-weight:400;">
                                        Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                                    </span>
                                    <div class="info_account" style="display:flex; justify-content: space-between; margin-top: 40px;flex-direction: column;">
                                        <div class="whereFrom" style="border-bottom: 1px dashed rgba(0, 0, 0, 0.2);border-top: 1px dashed rgba(0, 0, 0, 0.2);width:100%;padding-top:30px;padding-bottom: 30px;">
                   
                                            <div class="courseInfo" style="margin-bottom: 30px;background: #EFF3F6;border-radius: 10px;padding:10px;">
                                                <div class="infoCourse" style="display:flex;align-items:center;justify-content: space-between;">
                                                    <div class="innerCS" style="display: flex;
                                                    align-items: center;">
                                                        <div class="imageCourse" style="width:76px;height:100px;">
                                                            <!--Выводим превью курса-->
                                                            <img src="https://course-creator.io/envelope-images/envelope-zayavka.jpg" alt="Название курса" width="76px" height="100px" style="object-fit: cover;object-position:center;border-radius:6px">
                                                        </div>
                                                        <div class="aboutCourse" style="margin-left:20px;">
                                                            <div class="infoUrk">
                                                                <span style="text-align:center;background: #4DAA21;color:white;font-size:10px;font-weight:500;padding-top:4px;padding-bottom:4px;padding-right:6px;padding-left:6px;text-align: center;border-radius: 10px;">
                                                                    <!--Выводим название курса-->
                                                                    Курс
                                                                </span>
                                                            </div>
                                                            <div class="nameCourse" style="font-size:14px;color: rgba(0, 0, 0, 0.6);margin-top:11px;">
                                                                '. $name .'
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="priceCourse" style="display: flex;
                                                    flex-direction: column;
                                                    text-align: end;">
                                                        <span style="font-size:10px;font-weight:300;color: rgba(0, 0, 0, 0.6);">
                                                            Стоимость заказа
                                                        </span>
                                                        <span style="font-size:14px;font-weight:500;color: rgba(0, 0, 0, 0.6);margin-top:11px;">
                                                            '. $cost .'
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="whom" style="padding-bottom: 30px;border-bottom: 1px dashed rgba(0, 0, 0, 0.2);margin-bottom: 30px;">
                                            <div class="email" style="margin-bottom:20px;display:flex; justify-content: space-between">
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    Email:
                                                </span>
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    '. $email .'
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link_account">
                                        <div class="first_row" style="width:100%">
                                            <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                                Смотрите другие заявки на сайте:
                                            </p>
                                            <div style="background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                                <a href="https://course-creator.io/" target="_blank" style="color: #8098AB;">
                                                    https://course-creator.io/
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                                <div>
                                    Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                                </div>
                            </div>
                        </body>
                        </html>';
        }

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
            if (isset($_POST['first_name'])) {
                $this->name = $_POST['first_name'];
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
                $title = "Оставили заявку";
                if (isset($_POST['file'])) {
                    $file = $_POST['second_file'];
                    $file_name = "Прикреплённый файл";
                    $body = $this->GetApplicationHtml();
                    $this->SendEmail($title, $body, $_POST['email'], $file, $file_name);
                } else {
                    $body = $this->GetApplicationHtml();
                    $this->SendEmail($title, $body, $_POST['email']);
                }
                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], 0);
            }
            return true;
        }

        public function BuyCourse() {
            if (!$this->RequestValidate()) return false;

            $buy_progress = include './settings/buy_progress.php';
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            $comment = 'Купил курс';
            $client = $this->GetClient($course_id);
            $give_money = $client[0]['give_money'] + $this->GetPriceOfCourse($course_id)[0]['price'];

//          Добавление User
            if (count($this->m->getUserByEmail($this->email)) != 1) {

                $title = "Регистрация аккаунта";
                $this->password = $this->GenerateRandomPassword(12);
                $body = $this->GetRegistrationUserHtml($this->email, $this->password);
                $this->SendEmail($title, $body, $this->email);

                $this->m->db->execute("INSERT INTO `user` (`email`, `password`, `is_creator`) VALUES ('$this->email', '$this->password', 0)");

                if (isset($this->name)) {
                    $this->m->db->execute("INSERT INTO `user` (`first_name`) VALUES ('$this->name') WHERE `email` = '$this->email'");
                }

                if (isset($this->phone)) {
                    $this->m->db->execute("INSERT INTO `user` (`telephone`) VALUES ('$this->phone') WHERE `email` = '$this->email'");
                }
                $res = $this->m->getUserByEmail($this->email);
            }

            if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
//          Добавление Clients
                if (count($client) == 1){
                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money', `first_buy` = 0 WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
                } else {
                    $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);
                }

//          Добавление Order
                $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
                $this->m->db->execute("INSERT INTO `orders` (`user_id`, `course_id`, `creator_id`, `money`, `achivment_date`) VALUES ('". $_SESSION['user']['id'] ."', '$course_id', '$creator_id', '$give_money', '$current_date')");


//              Добавление Purchase
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
                $course_info = $this->m->db->query("SELECT course.name, course.price, user.email FROM course INNER JOIN user ON user.id = course.author_id WHERE course.id = $course_id");

//              Добавление уведомлений
                $this->addNotifications("item-like", 'Вы купили курс ' . $course_info[0]['name'], '/img/Notification/message.png', $_SESSION['user']['id']);
                $this->addNotifications("item-like", 'Ваш курс ' . $course_info[0]['name'] . ' купил пользователь' . $this->name, '/img/Notification/message.png', $creator_id);
                $title = "У вас купили курс!";
                $body = $this->GetRegistrationClientHtml($course_info[0]['name'], $course_info[0]['price'], $this->email);
                $this->SendEmail($title, $body, $course_info[0]['email']);
                return true;
            }
            return true;
        }

//        public function BuyVideo() {
//            if (!$this->RequestValidate()) return false;
//            $buy_progress = include './settings/buy_progress.php';
//            $creator_id = $_POST['creator_id'];
//            $video_id = $_POST['course_id'];
//            $course__real_id = $this->m->db->query("SELECT course_id FROM course_content WHERE id = '$video_id'")[0]['course_id'];
//            $comment = 'Купил видео';
//            $client = $this->GetClient($course__real_id);
//            $price_video = $this->GetPriceOfVideo($video_id)[0]['price'];
//            $give_money = $client[0]['give_money'] + $price_video;
//
//          Добавление User
//            if (count($this->m->getUserByEmail($this->email)) != 1) {
//                $title = "Регистрация аккаунта";
//                $this->password = $this->GenerateRandomPassword(12);
//                $body = "Ваш аккаунт на <a href=\"https://course-creator.io/UserLogin\">Course Creator</a><br>Почта: $this->email<br>Пароль:$this->password";
//
//                $this->SendEmail($title, $body, $this->email);
//
//                $this->m->db->execute("INSERT INTO `user` (`email`, `password`, `is_creator`) VALUES ('$this->email', '$this->password', 0)");
//
//                if (isset($this->name)) {
//                    $this->m->db->execute("INSERT INTO `user` (`first_name`) VALUES ('$this->name') WHERE `email` = '$this->email'");
//                }
//
//                if (isset($this->phone)) {
//                    $this->m->db->execute("INSERT INTO `user` (`telephone`) VALUES ('$this->phone') WHERE `email` = '$this->email'");
//                }
//                $res = $this->m->getUserByEmail($this->email);
//
//                $_SESSION["user"] = [
//                    'id' => $res[0]['id'],
//                    'email' => $res[0]['email'],
//                    'is_creator' => 0
//                ];
//            }


//            if ($client[0]['buy_progress'] <= $buy_progress[$comment]) {
//
////              Добавление Clients
//                if (count($client) == 1){
//                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money', `first_buy` = 0 WHERE `creator_id` = '$creator_id' AND `course_id` = '$course__real_id' AND `email` = '$this->email'");
//                } else {
//                    $this->InsertToTable($creator_id, $course__real_id, $buy_progress[$comment], $give_money);
//                }
//
////                     Добавление Order
//                    $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
//                    $this->m->db->execute("INSERT INTO `orders` (`user_id`,`course_id`, `course_content_id`, `creator_id`, `money`, `achivment_date`) VALUES ('". $_SESSION['user']['id'] ."', '$course__real_id', '$video_id', '$creator_id', '$price_video', '$current_date')");
//
//
//                    //          Добавление Purchase
//                    $purchase = $this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id']);
//                    if (isset($purchase) && count($purchase) == 1) {
//                        $purchase_info = json_decode($purchase[0]['purchase'], true);
//                        if (!in_array($video_id, $purchase_info['video_id'])) {
//                            array_push($purchase_info['video_id'], $video_id);
//                            $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_info) . "' WHERE user_id = " . $_SESSION['user']['id']);
//                        }
//                    } else {
//                        $user_id = $_SESSION['user']['id'];
//                        $purchase_text = '{"course_id":[], "video_id":["'.$video_id.'"]}';
//                        $this->m->db->execute("INSERT INTO `purchase` (`user_id`, `purchase`) VALUES ('$user_id', '$purchase_text')");
//                    }
//
//        //          Проверка покупки всех видео
//                    $purchase_video = json_decode($this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id'])[0]['purchase'], true);
//                    $id = $this->m->db->query("SELECT course_content.course_id FROM course_content WHERE id = '$video_id'")[0]['course_id'];
//                    $course_list = explode(',', $this->m->db->query("SELECT GROUP_CONCAT(`id`) FROM `course_content` WHERE course_id = '$id'")[0]['GROUP_CONCAT(`id`)']);
//                    foreach ($course_list as $item) {
//                        if (!in_array($item, $purchase_video['video_id'])) {
//                            return true;
//                        }
//                    }
//                    foreach ($purchase_video['video_id'] as $key=>$item) {
//                        if (in_array($item, $course_list)) unset($purchase_video['video_id'][$key]);
//                    }
//                    array_push($purchase_video['course_id'], $id);
//                    $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_video) . "' WHERE user_id = " . $_SESSION['user']['id']);
//                    $video_name = $this->m->db->query("SELECT name FROM course_content WHERE id = $video_id")[0]['name'];
//
//    //              Добавление уведомлений
//
//                    $this->addNotifications("item-like", 'Вы купили видео ' . $video_name, '/img/Notification/message.png', $_SESSION['user']['id']);
//                    $this->addNotifications("item-like", 'Ваш урок ' . $video_name . ' купил пользователь' . $this->name, '/img/Notification/message.png', $creator_id);
//                    return true;
//                }
//            return true;
//        }

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