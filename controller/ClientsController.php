<?php
    class ClientsController extends ACore {

        private $email;
        private $name;
        private $phone;

        private function GetClient($creator_id, $course_id) {
            return $this->m->db->query("SELECT * FROM `clients` WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
        }

        private function GetPriceOfCourse($course_id) {
            return $this->m->db->query("SELECT * FROM `course` WHERE id = '$course_id'");
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
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

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
            $client = $this->GetClient($creator_id, $course_id);
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
            $client = $this->GetClient($creator_id, $course_id);
            $give_money = $client[0]['give_money'] + $this->GetPriceOfCourse($course_id)[0]['price'];

            if (count($client) == 1){
                if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money' WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
                }
            } else {
                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);

                $sURL = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://$_SERVER[HTTP_HOST]/send-email"; // URL-адрес POST
                $sPD = "email=".$this->email; // Данные POST
                if (isset($this->name)) {
                    $sPD = $sPD . '&name=' . $this->name;
                }
                if (isset($this->phone)) {
                    $sPD = $sPD . '&phone=' . $this->phone;
                }
                $aHTTP = array(
                    'http' => // Обертка, которая будет использоваться
                        array(
                            'method'  => 'POST', // Метод запроса
                            // Ниже задаются заголовки запроса
                            'header'  => 'Content-type: application/x-www-form-urlencoded',
                            'content' => $sPD
                        )
                );
                $context = stream_context_create($aHTTP);
                $contents = file_get_contents($sURL, false, $context);
                echo $contents;
            }
            return true;
        }

        public function BuyVideo() {
            $buy_progress = include './settings/buy_progress.php';
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            $comment = 'Купил видео';
            $client = $this->GetClient($creator_id, $course_id);
            $video_cost = $_POST['video_cost'];
            $give_money = $client[0]['give_money'] + $video_cost;

            if (count($client) == 1){
                if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
                    $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money' WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
                }
            } else {
                $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);

                $sURL = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://$_SERVER[HTTP_HOST]/send-email"; // URL-адрес POST
                $sPD = "email=".$this->email; // Данные POST
                if (isset($this->name)) {
                    $sPD = $sPD . '&name=' . $this->name;
                }
                if (isset($this->phone)) {
                    $sPD = $sPD . '&phone=' . $this->phone;
                }
                $aHTTP = array(
                    'http' => // Обертка, которая будет использоваться
                        array(
                            'method'  => 'POST', // Метод запроса
                            // Ниже задаются заголовки запроса
                            'header'  => 'Content-type: application/x-www-form-urlencoded',
                            'content' => $sPD
                        )
                );
                $context = stream_context_create($aHTTP);
                $contents = file_get_contents($sURL, false, $context);
                echo $contents;
            }
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

        public function InsertToTable($creator_id, $course_id, $buy_progress, $course_price) {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $this->m->db->execute("INSERT INTO `clients` (`first_name`, `email`, `tel`, `creator_id`, `course_id`, `give_money`, `buy_progress`, `achivment_date`) VALUES ('$this->name', '$this->email', '$this->phone', '$creator_id', '$course_id', '$course_price', '$buy_progress', '$current_date')");
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
                        window.location.replace("/Analytics");
                    </script>
                </body>
                </html>';
        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }