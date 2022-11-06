<?php
    class ClientsController extends ACore {

        private $email;
        private $name;
        private $tel;

        public function RequestValidate()
        {
            $this->email = $_POST['email'];
            if (isset($_POST['name'])) {
                $this->name = $_POST['name'];
                if (!preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$this->name)) {
                    return false;
                }
            }
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            if (isset($_POST['tel'])) {
                $this->tel = $_POST['tel'];
            } else {
                $this->tel = null;
            }
            return True;
        }

        public function Create() {
            if (!$this->RequestValidate()) return false;
            $creator_id = $_POST['creator_id'];
            $course_id = $_POST['course_id'];
            $comment = 'Оставить заявку';
            $this->InsertToTable($creator_id, $course_id, $comment);
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

        public function InsertToTable($creator_id, $course_id, $comment) {
            $this->m->db->execute("INSERT INTO `clients` (`first_name`, `email`, `tel`, `creator_id`, `course_id`, `comment`, `give_money`) VALUES ('$this->name', '$this->email', '$this->tel', '$creator_id', '$course_id', '$comment', 0)");
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