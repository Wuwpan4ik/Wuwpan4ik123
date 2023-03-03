<?php

    class ClientsController extends ACoreCreator {
        use GenerateRandomPassword;
        use RequestValidate;

        private $password;
        private $name;
        private $phone;

        private function GetApplicationHtml ($email, $url, $name_funnel = null, $number_slide = null, $phone = null, $name = null) {
            return include "./template/templates_email/zayavka-s-saita(client).php";
        }

        private function GetRegistrationClientHtml($name, $cost, $email, $course_count, $currency = '₽', $phone = null, $user_name = null, $number_funnel = null, $number_slide = null)
        {
            $result = include "./template/templates_email/u-vas-kupili-kurs(client).php";
            return $result;
        }

        private function GetClient($course_id) {
            return $this->clients->GetClientByIdAndEmail($course_id, $this->email);
        }

        private function GetPriceOfCourse($course_id) {
            return $this->course->Get(["id" => $course_id]);
        }

        public function InsertToTable($creator_id, $course_id, $buy_progress, $course_price) {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $data = [
                "first_name" => $this->name,
                "email" => $this->email,
                "tel" => $this->phone,
                "creator_id" => $creator_id,
                "course_id" => $course_id,
                "give_money" => $course_price,
                "buy_progress" => $buy_progress,
                "achivment_date" => $current_date
            ];
            $this->clients->InsertQuery("clients", $data);

            return true;
        }

        public function AddApplication() {
            if (!$this->RequestValidate()) return false;

            $buy_progress = include './settings/buy_progress.php';
            $url = include "./settings/site_url.php";
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            $funnel = $this->funnel->Get(["id" => $_POST['funnel_id']]);

            if (isset($_POST['funnel_id'])) {
                $name_funnel = $funnel[0]['name'];
            }

            if (isset($_POST['slide_id'])) {
                $number_slide = $_POST['slide_id'];
            }

            $creator_email = $this->user->getUserById($creator_id)[0]['email'];
            $comment = 'Заявка';
            $client = $this->GetClient($course_id);
            if (count($client) == 1){
                if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
                    $this->clients->UpdateQuery("clients", ["buy_progress" => $buy_progress[$comment]], "WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
                } else {
                    echo 'error';
                    die(header("HTTP/1.0 404 Not Found"));
                }
            } else {
                $title = "Оставили заявку";
                $thubn_url = $this->course_content->Get(["course_id" => $course_id])[0]['thubnails'];
                $body = $this->GetApplicationHtml($this->email,"{$url}/$thubn_url}" , $name_funnel, $number_slide, $this->phone, $this->name);

                $f = $this->clients->GetApi();
                $this->api_key = $f['api_key'];
                $this->api_endpoint = $f['endpoint'];
                $this->SendEmail(
                    [
                        "from" => "{$this->ourEmail}",
                        "to" => "{$creator_email}",
                        "sender" => "{$this->ourEmail}",
                        "subject" => "{$title}",
                        "content" => "$body",
                        "is_send_now" => 1
                    ]
                );

                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], 0);
                $this->notifications_class->addNotifications("У вас новая заявка", "В вашей воронке $name_funnel оставленна заявка на слайде #$number_slide от {$this->email}", '/img/Notification/message.svg','item-like', $creator_id);
            }
            return true;
        }

        public function BuyCourse() {
            if (!$this->RequestValidate()) return false;

            $buy_progress = include './settings/buy_progress.php';
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            $client = $this->GetClient($course_id);
            $comment = 'Купил курс';

            if (isset($_POST['funnel_id'])) {
                $name_funnel = $this->funnel->Get(["id" => $_POST['funnel_id']])[0]['name'];
            }
            if (isset($_POST['slide_id'])) {
                $number_slide = $_POST['slide_id'];
            }

            //          Проверка на покупку того же курса
            if (isset($client) && ($client[0]['buy_progress'] == $buy_progress[$comment])) {
                die(header("HTTP/1.0 404 Not Found"));
            }


            $give_money = $client[0]['give_money'] + $this->GetPriceOfCourse($course_id)[0]['price'];

//          Добавление User

            if (count($this->user->getUserByEmail($this->email)) != 1) {
                $this->password = $this->GenerateRandomPassword(12);
                $data = [
                    "email" => $this->email,
                    "password" => $this->password,
                    "is_creator" => 0
                ];
                $this->user->InsertQuery("user", $data);

                $query = [];
                if (isset($this->name)) {
                    $query["first_name"] = $this->name;
                }

                if (isset($this->phone)) {
                    $query["telephone"] = $this->phone;
                }

                if (!empty($query)) {
                    $this->user->UpdateQuery("user", $query, "WHERE `email` = '$this->email'");
                }
            }

            $res = $this->user->getUserByEmail($this->email)[0];
            $purchase = $this->purchase->GetQuery("purchase", ["user_id" => $res['id']]);

            if (isset($client) && ($client[0]['buy_progress'] < $buy_progress[$comment])) {

//          Добавление Clients
            if (count($client) == 1) {
                $data = [
                    "buy_progress" => $buy_progress[$comment],
                    "give_money" => $give_money,
                    "first_buy" => 0
                ];
                $this->clients->UpdateQuery("clients", $data, "WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
            } else {
                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);
            }

//          Добавление Order
                $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
                $data = [
                    "user_id" => $res['id'],
                    "course_id" => $course_id,
                    "creator_id" => $creator_id,
                    "money" => $give_money,
                    "achivment_date" => $current_date
                ];
                $this->orders->InsertQuery("orders", $data);

//              Добавление Purchase
                if (isset($purchase) && count($purchase) == 1) {
                    $purchase_info = json_decode($purchase[0]['purchase'], true);
                    if (!in_array($course_id, $purchase_info['course_id'])) {
                        array_push($purchase_info['course_id'], $course_id);
                        $this->purchase->UpdateQuery("purchase", ["purchase" => json_encode($purchase_info)], "WHERE user_id = " . $res['id']);
                    } else {
                        return false;
//                      Тут ошибка если уже покупал курс
                    }
                } else {
                    $purchase_text = '{"course_id":["' . $course_id . '"], "video_id":[]}';
                    $this->purchase->InsertQuery("purchase", ["user_id" => $res['id'], "purchase" => $purchase_text]);
                }
                $course_info = $this->course->GetCourseInfoForNotifications($course_id);

                $creator = $this->user->getUserById($creator_id);

//              Добавление уведомлений
                $this->notifications_class->addNotifications("Вы купили курс", "Доступный курс - {$course_info['name']}", '/img/Notification/star.svg', 'item-like', $res['id']);
                $this->notifications_class->addNotifications("У вас купили курс", "Ваш курс - “{$course_info['name']}”, купил {$this->email}", '/img/Notification/star.svg', 'item-like', $creator_id);
                $creator_username = strtolower($creator[0]['username']);
                $url = "https://{$creator_username}.course-creator.io/";
                $body = include "./template/templates_email/registracia-usera(user).php";
                $this->SendEmail(
                    [
                        "from" => "{$this->ourEmail}",
                        "to" => "{$this->email}",
                        "sender" => "{$this->ourEmail}",
                        "subject" => "Покупка курса",
                        "content" => "$body",
                        "is_send_now" => 1
                    ]
                );

                $phone = ($this->phone) ? $this->phone : null;
                $name = ($this->name) ? $this->name : null;

                $body = $this->GetRegistrationClientHtml($course_info['name'], $course_info['price'], $this->email, $course_info['count'], $res['currency'], $phone, $name, $name_funnel, $number_slide);
                $this->SendEmail(
                    [
                        "from" => "{$this->ourEmail}",
                        "to" => "{$course_info['email']}",
                        "sender" => "{$this->ourEmail}",
                        "subject" => "У вас к упили курс",
                        "content" => "$body",
                        "is_send_now" => 1
                    ]
                );
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