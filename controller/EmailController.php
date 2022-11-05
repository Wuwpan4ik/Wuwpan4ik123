<?php
    class EmailController extends ACore {

        private $email;
        private $name;
        private $password;
        private $ourEmail = "dimalim110@gmail.com";

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

            if (count($this->m->db->query("SELECT * FROM user WHERE email = '$this->email'")) != 0) {
                return false;
            }

            $this->password = $this->GenerateRandomPassword(12);
            $this->SendEmail();
            return True;
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

        public function SendEmail () {

//            if (!$this->RequestValidate()) $this->get_content();
            $this->email = $_POST['email'];
            if (isset($_POST['name'])) {
                $this->name = $_POST['name'];
            }
            $this->password = $this->GenerateRandomPassword(9);
            $to = $this->email;

            // тема письма
            $subject = 'Ваш аккаунт на Course Creator!';

            // текст письма
            $message = "Вы успешно зарегестрировались на Course Creator! <br>Можете войти в аккаунт по указанным данным:<br>"
                . "Email: $this->email <br>Password: $this->password";
            ;

            // Для отправки HTML-письма должен быть установлен заголовок Content-type
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Дополнительные заголовки
            $headers .= "To: CourseCreator $this->ourEmail" . "\r\n"; // Свое имя и email
            $headers .= 'From: '  . "Course-Creator" . '<' . $this->ourEmail . '>' . "\r\n";


            // Отправляем
            if (mail($to, $subject, $message, $headers)) {$_SESSION['mail'] = 'Сработало';} else {$_SESSION['mail'] = 'НеСработало';};
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
        }
    }