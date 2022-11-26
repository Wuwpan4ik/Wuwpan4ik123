<?php
class AccountController extends ACoreCreator {

    public function IsFreedomSiteName () {
        $site_url = $_GET['site_url'];

        if ((int)$this->m->db->query("SELECT count(*) FROM user WHERE `site_url` = " . $site_url) > 0) {
            return False;
        }
        return True;
    }

    public function SaveSchoolSettings()
    {
        $user = $this->m->db->query("SELECT * FROM user WHERE `id` = ". $_SESSION['user']['id']);

        if (strlen($_POST['school_name']) == 0) {
            $school_name = $user[0]['school_name'];
        } else {
            $school_name = $_POST['school_name'];
        }

        if (strlen($_POST['niche']) == 0) {
            $niche = $user[0]['niche'];
        } else {
            $niche = $_POST['niche'];
        }

        if (strlen($_POST['school_desc']) == 0) {
            $school_desc = $user[0]['school_desc'];
        } else {
            $school_desc = $_POST['school_desc'];
        }
        $this->m->db->execute("UPDATE user SET `school_name` = '$school_name', `school_desc` = '$school_desc', `niche` = '$niche' WHERE id = " . $_SESSION['user']['id']);
        $_SESSION["user"]['school_name'] = $school_name;
        $_SESSION["user"]['school_desc'] = $school_desc;
        $_SESSION["user"]['niche'] = $niche;
        return true;
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
                $_SESSION['error']['email_message'] = 'Такой email уже зарегистрирован';
                return False;
            }
            $email = $_POST['email'];
        }

        if (strlen($_POST['first_name']) == 0) {
            $first_name = $user[0]['first_name'];
        } else {
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['first_name'])) {
                $_SESSION['error']['first_name_message'] = 'Имя содержит запрещенные знаки';
            }
            $first_name = $_POST['first_name'];
        }

        if (strlen($_POST['second_name']) == 0) {
            $second_name = $user[0]['second_name'];
        } else {
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['second_name'])) {
                $_SESSION['error']['second_name_message'] = 'Фамилия содержит запрещенные знаки';
            }
            $second_name = $_POST['second_name'];
        }

        if (strlen($_POST['phone']) == 0) {
            $phone = $user[0]['telephone'];
        } else {
            $phone = $_POST['phone'];
        }

        if (strlen($_POST['city']) == 0) {
            $city = $user[0]['city'];
        } else {
            $city = $_POST['city'];
        }

        if (strlen($_POST['country']) == 0) {
            $country = $user[0]['country'];
        } else {
            $country = $_POST['country'];
        }
        if($_FILES['avatar']['name']){

            $avatar = "uploads/ava/" . $email. "_" .$_FILES['avatar']['name'];

            move_uploaded_file($_FILES['avatar']['tmp_name'], "./".$avatar);

        } else {
            $avatar = $user[0]['avatar'];
        }

        $this->m->db->execute("UPDATE user SET `email` = '$email', `avatar` = '$avatar', `first_name` = '$first_name', `second_name` = '$second_name', `telephone` = '$phone' WHERE id = " . $_SESSION['user']['id']);
        $_SESSION["user"]['first_name'] = $first_name;
        $_SESSION["user"]['second_name'] = $second_name;
        $_SESSION["user"]['email'] = $email;
        $_SESSION["user"]['phone'] = $phone;
        $_SESSION["user"]['city'] = $city;
        $_SESSION["user"]['country'] = $country;
        $_SESSION['user']['avatar'] = $avatar;
        return true;
    }

    function SaveUserSettings() {
        $user = $this->m->db->query("SELECT * FROM user WHERE `id` = ". $_SESSION['user']['id']);

        if (strlen($_POST['first_name']) == 0) {
            $first_name = $user[0]['first_name'];
        } else {
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['first_name'])) {
                $_SESSION['error']['first_name_message'] = 'Имя содержит запрещенные знаки';
            }
            $first_name = $_POST['first_name'];
        }

        if (strlen($_POST['second_name']) == 0) {
            $second_name = $user[0]['second_name'];
        } else {
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$_POST['second_name'])) {
                $_SESSION['error']['second_name_message'] = 'Фамилия содержит запрещенные знаки';
            }
            $second_name = $_POST['second_name'];
        }

        if (strlen($_POST['old_pass']) != 0) {
            if ($user[0]['password'] == $_POST['old_pass']) {
                if ($_POST['new_pass'] == $_POST['new_pass_repeat']) {
                    $password = $_POST['new_pass'];
                    $this->m->db->execute("UPDATE user SET `password` = '$password' WHERE id = " . $_SESSION['user']['id']);
                    $this->addNotifications("item-like", 'Ваш пароль изменён', '/img/Notification/message.png', $_SESSION['user']['id']);
                }
            } else {
                $request = "Неверный пароль";
            }
        }
        $this->m->db->execute("UPDATE user SET `first_name` = '$first_name', `second_name` = '$second_name' WHERE id = " . $_SESSION['user']['id']);
        $_SESSION["user"]['first_name'] = $first_name;
        $_SESSION["user"]['second_name'] = $second_name;
    }

    function get_content()
    {
//        echo '<!DOCTYPE html>
//                <html lang="en">
//                <head>
//                <meta charset="UTF-8">
//                <meta http-equiv="X-UA-Compatible" content="IE=edge">
//                <meta name="viewport" content="width=device-width, initial-scale=1.0">
//                <title>Document</title>
//                </head>
//                <body>
//                    <script>
//                        window.history.go(-1);
//                    </script>
//                </body>
//                </html>';
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}