<?php
    trait RequestValidate {
        public function RequestValidate()
        {
            $this->email = $_POST['email'];
            if (isset($_POST['name'])) {
                $this->name = $_POST['name'];
                //                if (!preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$this->name)) {
                //                    return false;
                //                }
//              Через header пусть ошибку выводит

            }

//            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
//                return false;
//            }

            if (isset($_POST['phone'])) {
                $this->phone = $_POST['phone'];
            }

            return True;
        }
    }