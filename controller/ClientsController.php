<?php

    class ClientsController extends ACoreCreator {
        private $password;
        private $name;
        private $phone;

        private function GetApplicationHtml ($email, $name_funnel = null, $number_slide = null, $phone = null, $name = null) {
            $result = '<html lang="RU">
                            <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            </head>
                            <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                                <style>
                                    td, th{
                                        font-size: 16px;
                            font-weight: 400;
                            color: #666666;
                                        padding:10px 0px;
                                    }
                                </style>
                                <div class="envelope-container" style="max-width: 500px;width:100%;margin:0 auto;">
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
                                            <table style="width:100%;margin-top: 40px;border-bottom: 1px dashed rgba(0, 0, 0, 0.2);border-top: 1px dashed rgba(0, 0, 0, 0.2);width:100%;padding-top:30px;padding-bottom: 30px;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:start;">
                                                            Откуда заявка:
                                                        </th>
                                                        <th>
                            
                                                        </th>
                                                        <th style="text-align: end;">
                                                            '. $name_funnel .'
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:start;">
                                                            На каком слайде:
                                                        </th>
                                                        <th>
                            
                                                        </th>
                                                        <th style="text-align: end;">
                                                            Слайд №'. $number_slide .'
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        <table style="width:100%;padding-bottom:20px;padding-top:20px;border-bottom: 1px dashed rgba(0, 0, 0, 0.2);margin-bottom:30px;">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:start;">
                                                        Email:
                                                    </th>
                                                    <th>
                                
                                                    </th>
                                                    <th style="text-align: end;">
                                                        '. $email .'
                                                    </th>
                                                </tr>';
            if (!is_null($name)) {
                $result .= '
                                            <tr>
                                                <th style="text-align:start;">
                                                    Имя:
                                                </th>
                                                <th>
                                                </th>
                                                <th style="text-align: end;">
                                                    '. $name .'
                                                </th>
                                            </tr>
                                            ';
            }
            if (!is_null($phone)) {
                $result .= '
                                            <tr>
                                                <th style="text-align:start;">
                                                    Телефон:
                                                </th>
                                                <th>
                    
                                                </th>
                                                <th style="text-align: end;">
                                                    '. $phone .'
                                                </th>
                                            </tr>';
            }

            $result .= '
                                        </thead>
                                    </table>
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
                                <div style="font-size:12px;">
                                    Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                                </div>
                            </div>
                        </div>
                    </body>';

            return $result;
        }

        private function GetRegistrationUserHtml ($email, $password) {
            return '<html lang="RU">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                            <div class="envelope-container" style="max-width: 500px;
                            width: 100%;
                            margin: 0 auto;">
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
                                        <div class="info_account" style="margin-top: 40px;">
                                            <div class="first_row" style="width:100%">
                                                <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                                    Ваша почта:
                                                </p>
                                                <div style="color: #8098AB;background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                                    '. $email .'
                                                </div>
                                            </div>
                                            <br>
                                            <div class="second_row" style="width:100%">
                                                <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                                    Ваш пароль:
                                                </p>
                                                <div style="color: #8098AB;background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                                    '. $password .'
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
                                    <div style="font-size:12px;">
                                        Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                                    </div>
                                </div>
                            </div>
                        </body>
                        </html>';
        }

        private function GetRegistrationClientHtml($name, $cost, $email, $course_count, $phone = null, $user_name = null, $number_funnel = null, $number_slide = null)
        {
            $result = '
                    <html lang="RU">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                            <style>
                                td, th{
                                    font-size: 16px;
                        font-weight: 400;
                        color: #666666;
                                    padding:10px 0px;
                                }
                            </style>
                            <div class="envelope-container" style="max-width: 500px;
                            width: 100%;
                            margin: 0 auto;">
                                <div class="envelope-body" style="background:white;">
                                    <div class="first_row">
                                        <img style="width:100%;" src="https://course-creator.io/envelope-images/envelope-zayavka.jpg" alt="Добро пожаловать в Course Creator!">
                                    </div>
                                    <div class="second_row" style="padding:40px;">
                                        <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
                                            Поздравляем, у вас купили курс!
                                        </h2>
                                        <span style="color: #666666;font-size:16px;font-weight:400;">
                                            Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                                        </span>
                                        <div class="info_account" style="display:-webkit-box;
                                        display:-ms-flexbox;
                                        display:flex;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;gap: 20px;margin-top: 40px;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;">
                                            <div class="whereFrom" style="border-bottom: 1px dashed rgba(0, 0, 0, 0.2);border-top: 1px dashed rgba(0, 0, 0, 0.2);width:100%;padding-top:30px;padding-bottom: 30px;">
                                                
                                                <table style="width:100%;margin-bottom: 30px;
                                                background: #EFF3F6;
                                                border-radius: 10px;
                                                padding: 10px;">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align:start;width:76px;">
                                                                <img src="https://course-creator.io/envelope-images/envelope-zayavka.jpg" alt="Название курса" width="76px" height="100px" style="object-fit: cover;object-position:center;border-radius:6px">
                                                            </th>
                                                            <th style="width:10px;"></th>
                                                            <th style="text-align:start;">
                                                                <span style="width:20px;height:20px;text-align:center;background: #4DAA21;color:white;font-size:10px;font-weight:500;padding-top:4px;padding-bottom:4px;padding-right:6px;padding-left:6px;text-align: center;border-radius: 10px;">
                                                                    Курс
                                                                </span>
                                                                <span style="font-size:10px;font-weight:300;margin-left:9px;">
                                                                    '. $course_count .' урока
                                                                </span>
                                                                <br>
                                                                <p style="font-size: 14px;
                                                                color: #666666;
                                                                margin-top: 11px;">
                                                                    '. $name .'
                                                                </p>
                                                            </th>
                                                            <th style="text-align: end;width:70px;">
                                                                <p style="font-size:10px;font-weight:300;color: #666666;">
                                                                    Стоимость заказа
                                                                </p>
                                                                <span style="font-size:14px;font-weight:500;color: #666666;margin-top:11px;">
                                                                    '. $cost .' ₽
                                                                </span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                <table>';
            if (!is_null($number_funnel)) {
                $result .= '
                                        <thead>
                                            <tr>
                                                <th style="text-align:start;width:50%">
                                                    Откуда заявка:
                                                </th>
                                                <th style="width:100px"></th>
                                                <th style="text-align:end;width:50%">
                                                    Воронка №'. $number_funnel .'
                                                </th>
                                            </tr>
                                        </thead>';
            }
            if (!is_null($number_slide)) {
                $result .= '
                                        <tbody>
                                            <tr>
                                                <th style="text-align:start" scope="row">
                                                    На каком слайде:
                                                </th>
                                                <td style="width:100%">
                                                    
                                                </td>
                                                <td style="text-align:end">
                                                    Слайд №'. $number_slide .'
                                                </td>
                                            </tr>
                                        </tbody>';
            }
            $result .= '
                                    </table>
                                    <table>';
            if (!is_null($user_name)) {
            $result .= '
                                        <thead>
                                            <tr>
                                                <th style="text-align:start">
                                                    Имя:
                                                </th>
                                                <td style="width:100%">
                                                    
                                                </td>
                                                <td style="text-align:end">
                                                    '. $user_name .'
                                                </td>
                                            </tr>
                                        </thead>';
            };
            $result .= '<tbody>';
            if (!is_null($phone)) {
                $result .= '
                                        <tr>
                                            <th style="text-align:start" scope="row">
                                                Телефон:
                                            </th>
                                            <td style="width:100%">
            
                                            </td>
                                            <td style="text-align:end">
                                                '. $phone .'
                                            </td>
                                        </tr>';
            };
            $result .= '
                                        <tr>
                                            <th style="text-align:start" scope="row">
                                                Email:
                                            </th>
                                            <td style="width:100%">
                                                
                                            </td>
                                            <td style="text-align:end">
                                                '. $email .'
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="link_account" style="margin-top:30px;">
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
                    <div style="font-size:12px;">
                        Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                    </div>
                </div>
            </div>
        </body>
        </html>';
            return $result;
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
            } else {
                $this->name = null;
            }
//                if (!preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$this->name)) {
//                    return false;
//                }
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
            if (isset($_POST['funnel_id'])) {
                $name_funnel = $this->m->getFunnelById($_POST['funnel_id'])[0]['name'];
            }
            if (isset($_POST['slide_id'])) {
                $number_slide = $_POST['slide_id'];
            }
            $creator_email = $this->m->db->query("SELECT email FROM user WHERE id = {$creator_id}")[0]['email'];
            $comment = 'Заявка';
            $client = $this->GetClient($course_id);
            if (count($client) == 1){
                if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]' WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
                } else {
                    return False;
                }
            } else {
                $title = "Оставили заявку";

                    $body = $this->GetApplicationHtml($this->email, $name_funnel, $number_slide, $this->phone, $this->name);
                    $this->SendEmail($title, $body, $creator_email);
//                }
                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], 0);
                $this->addNotifications("У вас новая заявка", "В вашей воронке $name_funnel оставленна заявка на слайде #$number_slide от {$this->email}", '/img/Notification/message.svg', $creator_id);
            }
            return true;
        }

        public function BuyCourse() {
            if (!$this->RequestValidate()) return false;

            $buy_progress = include './settings/buy_progress.php';
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            if (isset($_POST['funnel_id'])) {
                $name_funnel = $this->m->getFunnelById($_POST['funnel_id'])[0]['name'];
            }
            if (isset($_POST['slide_id'])) {
                $number_slide = $_POST['slide_id'];
            }
            $comment = 'Купил курс';
            $client = $this->GetClient($course_id);
            $give_money = $client[0]['give_money'] + $this->GetPriceOfCourse($course_id)[0]['price'];

//          Добавление User
            if (count($this->m->getUserByEmail($this->email)) != 1) {
                $this->password = $this->GenerateRandomPassword(12);

                $this->m->db->execute("INSERT INTO `user` (`email`, `password`, `is_creator`) VALUES ('$this->email', '$this->password', 0)");

                if (isset($this->name)) {
                    $this->m->db->execute("UPDATE `user` SET `first_name` = '$this->name' WHERE `email` = '$this->email'");
                }

                if (isset($this->phone)) {
                    $this->m->db->execute("UPDATE `user` SET `telephone` = '$this->phone' WHERE `email` = '$this->email'");
                }
            }
            $res = $this->m->getUserByEmail($this->email)[0];
            $title = "Покупка курса";
            $body = $this->GetRegistrationUserHtml($this->email, $this->password);
            $this->SendEmail($title, $body, $this->email);

            if (isset($client) && ($client[0]['buy_progress'] < $buy_progress[$comment])) {

//          Добавление Clients
                if (count($client) == 1){
                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money', `first_buy` = 0 WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
                } else {
                    $_SESSION['error'] = 100;
                    $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);
                }

//          Добавление Order
                $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
                $this->m->db->execute("INSERT INTO `orders` (`user_id`, `course_id`, `creator_id`, `money`, `achivment_date`) VALUES ('". $res['id'] ."', '$course_id', '$creator_id', '$give_money', '$current_date')");


//              Добавление Purchase
                $purchase = $this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $res['id']);
                if (isset($purchase) && count($purchase) == 1) {
                    $purchase_info = json_decode($purchase[0]['purchase'], true);
                    if (!in_array($course_id, $purchase_info['course_id'])) {
                        array_push($purchase_info['course_id'], $course_id);
                        $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_info) . "' WHERE user_id = " . $res['id']);
                    }
                } else {
                    $purchase_text = '{"course_id":["'.$course_id.'"], "video_id":[]}';
                    $this->m->db->execute("INSERT INTO `purchase` (`user_id`, `purchase`) VALUES ('{$res['id']}', '$purchase_text')");
                }
                $course_info = $this->m->db->query("SELECT course.name, course.price, user.email, count(course_content.id) as 'count' FROM course INNER JOIN user ON user.id = course.author_id INNER JOIN course_content on course_content.course_id = course.id WHERE course.id = $course_id")[0];

//              Добавление уведомлений
                $this->addNotifications("Вы купили курс", "Доступный курс - {$course_info[0]['name']}", '/img/Notification/star.svg', $res['id']);
                $this->addNotifications("У вас купили курс", "Ваш курс - “{$course_info[0]['name']}”, купил {$this->email}", '/img/Notification/star.svg', $creator_id);
                $title = "У вас купили курс!";
                $phone = ($this->phone) ? $this->phone : null;
                $name = ($this->name) ? $this->name : null;
                $body = $this->GetRegistrationClientHtml($course_info['name'], $course_info['price'], $this->email, $course_info['count'], $phone, $name, $name_funnel, $number_slide);
                $this->SendEmail($title, $body, $course_info['email']);
                $this->get_content();
            }
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