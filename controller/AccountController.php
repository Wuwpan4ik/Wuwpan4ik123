<?php
class AccountController extends ACoreCreator {

    public function IsFreedomSiteName () {
        $site_url = $_GET['site_url'];

        if ((int)$this->m->db->query("SELECT count(*) FROM user WHERE `site_url` = " . $site_url) > 0) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return False;
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
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

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function SaveSettings() {
        $user = $this->m->db->query("SELECT * FROM user WHERE `id` = ". $_SESSION['user']['id']);

        if (strlen($_POST['email']) == 0) {
            $email = $user[0]['email'];
        } else {
            $email = $_POST['email'];
            if ($email != $user[0]['email']) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error']['email_message'] = 'Неверный email';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    return False;
                }

                if (count($this->m->db->query("SELECT * FROM user WHERE email = '$email'")) != 0 && $email != $_SESSION['user']['email']) {
                    $_SESSION['error']['email_message'] = 'Такой email уже зарегистрирован';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    return False;
                }
            }
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

        if (strlen($_POST['currency']) == 0) {
            $currency= $user[0]['currency'];
        } else {
            $currency = $_POST['currency'];
        }

        if (strlen($_POST['birthday']) == 0) {
            $birthday = $user[0]['birthday'];
        } else {
            $birthday = $_POST['birthday'];
        }

        if($_FILES['avatar']['size'] != 0) {

            $avatar = "./uploads/ava/" . $email . substr($_FILES['avatar']['name'], -4);

            move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);

        } else {
            $avatar = $user[0]['avatar'];
        }

        $this->m->db->execute("UPDATE `user` SET `email` = '$email', `birthday` = '$birthday', `first_name` = '$first_name', `second_name` = '$second_name', `telephone` = '$phone', `currency` = '$currency', `city` = '$city', `country` = '$country' WHERE id = {$user[0]['id']}");
        $this->m->db->execute("UPDATE `user` SET `avatar` = '$avatar' WHERE id = {$user[0]['id']}");

        $_SESSION["user"]['first_name'] = $first_name;
        $_SESSION["user"]['second_name'] = $second_name;
        $_SESSION["user"]['email'] = $email;
        $_SESSION["user"]['phone'] = $phone;
        $_SESSION["user"]['currency'] = $currency;
        $_SESSION["user"]['city'] = $city;
        $_SESSION["user"]['country'] = $country;
        $_SESSION['user']['avatar'] = $avatar;
        $_SESSION['user']['birthday'] = $birthday;

        header('Location: ' . $_SERVER['HTTP_REFERER']);
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

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function SaveSocialSettings() {
        $social = $_POST['social'];
        $link = $_POST['link'];
        if ($this->m->isUserSocials()) {
            $this->m->db->execute("UPDATE `user_contacts` SET `". $social ."` = '". $link ."' WHERE user_id = " . $_SESSION['user']['id']);
        } else {
            $this->m->db->execute("INSERT INTO `user_contacts` (`". $social ."`, `user_id`) VALUES ('". $link ."', ". $_SESSION['user']['id'] .")");
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function TakeSocialUrls() {
        echo json_encode($this->m->TakeSocialUrls());
        return true;
    }

    function get_content()
    {
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}