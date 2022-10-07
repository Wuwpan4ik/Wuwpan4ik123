<?php
class AccountController extends ACore {

    private function validate_data ($email, $name, $subname) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['email_message'] = 'Неверный email';
        }
        if ((int)$this->m->db->query("SELECT count(*) FROM user WHERE email = " . $_POST[email]) > 0) {
            $_SESSION['error']['email_message'] = 'Почта либо занята, либо это ваша';
        }
        if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['name'])) {
            $_SESSION['error']['name_message'] = 'Имя содержит запрещенные знаки';
        }
        if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['subname'])) {
            $_SESSION['error']['subname_message'] = 'Фамилия содержит запрещенные знаки';
        }
    }

    public function SaveSettings() {
        $email = $_POST['email'];
        $subname = $_POST['subname'];
        $name = $_POST['name'];

        // Проверка валидности
        $this->validate_data($email, $name, $subname);
        if (isset($_SESSION['email_message']) || isset($_SESSION['name_message']) || isset($_SESSION['subname_message'])) return False;
        // Проверка валидности

        $this->m->db->execute("UPDATE user SET `email` = '$email', `subname` = '$subname', `subname` = '$subname' WHERE id = " . $_SESSION['user']['id']);
        $_SESSION["user"]['name'] = $name;
        $_SESSION["user"]['subname'] = $subname;
        $_SESSION["user"]['email'] = $email;
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
                        window.location.replace("?option=Account");
                    </script>
                </body>
                </html>';
    }
}