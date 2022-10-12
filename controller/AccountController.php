<?php
class AccountController extends ACore {

    public function IsFreedomSiteName () {
        $site_url = $_GET['site_url'];

        if ((int)$this->m->db->query("SELECT count(*) FROM user WHERE `site_url` = " . $site_url) > 0) {
            return False;
        }
        return True;
    }

    public function SaveSettings() {
        $user = $this->m->db->query("SELECT * FROM user WHERE `id` = ". $_SESSION['user']['id']);

        if (strlen($_POST['email']) == 0) {
            $email = $user[0]['email'];
        } else {
            $temp_email = $_POST['email'];
            if (!filter_var($temp_email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error']['email_message'] = 'Неверный email';
                return False;
            }

            if (count($this->m->db->query("SELECT * FROM user WHERE email = '$temp_email'")) != 0) {
                $_SESSION['error']['email_message'] = 'Почта либо занята, либо это ваша';
                return False;
            }
            $email = $_POST['email'];
        }

        if (strlen($_POST['name']) == 0) {
            $name = $user[0]['name'];
        } else {
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['name'])) {
                $_SESSION['error']['name_message'] = 'Имя содержит запрещенные знаки';
                return False;
            }
            $name = $_POST['name'];
        }

        if (strlen($_POST['subname']) == 0) {
            $subname = $user[0]['subname'];
        } else {
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['subname'])) {
                $_SESSION['error']['subname_message'] = 'Фамилия содержит запрещенные знаки';
                return False;
            }
            $subname = $_POST['subname'];
        }

        if (strlen($_POST['site_url']) == 0) {
            $site_url = $user[0]['site_url'];
        } else {
            $site_url = $_POST['site_url'];
            $count = (int)($this->m->db->query("SELECT * FROM user WHERE `site_url` = '$site_url'"));
            if ($count != 0) {
                $_SESSION['error']['url_message'] = 'Данный Url уже занят';
                return False;
            }
        }

        $this->m->db->execute("UPDATE user SET `email` = '$email', `name` = '$name', `subname` = '$subname', `site_url` = '$site_url' WHERE id = " . $_SESSION['user']['id']);
        $_SESSION["user"]['name'] = $name;
        $_SESSION["user"]['subname'] = $subname;
        $_SESSION["user"]['email'] = $email;
        $_SESSION["user"]['site_url'] = $site_url;
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