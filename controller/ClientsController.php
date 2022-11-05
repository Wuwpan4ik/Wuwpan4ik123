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

        function Create() {
            if (!$this->RequestValidate()) return false;
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $this->m->db->execute("INSERT INTO `clients` (`first_name`, `email`, `tel`, `creator_id`, `course_id`, `comment`, `give_money`, `achivment_date`) VALUES ('$this->name', '$this->email', '$this->tel', '$creator_id', '$course_id', 'Оставил заявку', 0, '$current_date')");
            return true;
        }

        function get_content()
        {
            // TODO: Implement get_content() method.
        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }