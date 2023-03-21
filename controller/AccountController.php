<?php
class AccountController extends ACoreCreator {

    public function SaveSchoolSettings()
    {
        $user = $this->user->getCurrentUser();

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

        $data = [
            "school_name" => $school_name,
            "school_desc" => $school_desc,
            "niche" => $niche
        ];

        $this->user->UpdateQuery("user", $data, "WHERE id = " . $_SESSION['user']['id']);

        $_SESSION["user"]['school_name'] = $school_name;
        $_SESSION["user"]['school_desc'] = $school_desc;
        $_SESSION["user"]['niche'] = $niche;

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function SaveSettings() {
        $user = $this->user->getCurrentUser();

        if (strlen($_POST['email']) == 0) {
            $email = $user[0]['email'];
        } else {
            $email = $_POST['email'];
            if ($email != $user[0]['email']) {
//                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//                    $_SESSION['error']['email_message'] = 'Неверный email';
//                    header('Location: ' . $_SERVER['HTTP_REFERER']);
//                    return False;
//                }

                if (count($this->user->getUserByEmail($email)) != 0 && $email != $_SESSION['user']['email']) {
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

        $query_to_update_urls = [];
        if (count($this->user_contacts->getCurrentUserContacts()) === 0) {
            $data = ['user_id' => $_SESSION['user']['id']];
            $this->user->InsertQuery("user_contacts", $data);
        }

        if (strlen($_POST['vk']) != 0) {
            $query_to_update_urls['vk'] = $_POST['vk'];
        }

        if (strlen($_POST['instagram']) != 0) {
            $query_to_update_urls['instagram'] = $_POST['instagram'];
        }

        if (strlen($_POST['whatsapp']) != 0) {
            $query_to_update_urls['whatsapp'] = $_POST['whatsapp'];
        }

        if (strlen($_POST['telegram']) != 0) {
            $query_to_update_urls['telegram'] = $_POST['telegram'];
        }

        if (strlen($_POST['facebook']) != 0) {
            $query_to_update_urls['facebook'] = $_POST['facebook'];
        }

        if (strlen($_POST['youtube']) != 0) {
            $query_to_update_urls['youtube'] = $_POST['youtube'];
        }

        if (strlen($_POST['twitter']) != 0) {
            $query_to_update_urls['twitter'] = $_POST['twitter'];
        }

        if (strlen($_POST['site']) != 0) {
            $query_to_update_urls['site'] = $_POST['site'];
        }

        if($_FILES['avatar']['size'] != 0) {

            $avatar = "./uploads/ava/" . $email . substr($_FILES['avatar']['name'], -4);

            move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);

        } else {
            $avatar = $user[0]['avatar'];
        }

        if ($query_to_update_urls) {
            $this->user_contacts->UpdateQuery("user_contacts", $query_to_update_urls, "WHERE user_id = {$user[0]['id']}");
        }

        $data = [
            "email" => $email,
            "birthday" => $birthday,
            "first_name" => $first_name,
            "second_name" => $second_name,
            "telephone" => $phone,
            "currency" => $currency,
            "country" => $country,
            "city" => $city
        ];
        $this->user->UpdateQuery("user", $data, "WHERE id = {$_SESSION['user']['id']}");

        $this->user->UpdateQuery("user", ["avatar" => $avatar], "WHERE id = {$_SESSION['user']['id']}");

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
        return true;
    }

    public function SaveIntegrationsSettings()
    {
        if (strlen($_POST['prodamus_key']) != 0) {
            $query_to_update_urls['prodamus_key'] = $_POST['prodamus_key'];
        } else {
            $query_to_update_urls['prodamus_key'] = null;
        }

        if (strlen($_POST['albato_key']) != 0) {
            $query_to_update_urls['albato_key'] = $_POST['albato_key'];
        } else {
            $query_to_update_urls['albato_key'] = null;
        }

        if (count($this->user->getIntegrationsByUser()) === 0) {
            $this->user->InsertQuery("user_integrations", ["user_id" => $_SESSION['user']['id']]);
        }

        $this->user_integrations->UpdateQuery("user_integrations", $query_to_update_urls);

        $_SESSION['user']['prodamus_key'] = $query_to_update_urls['prodamus_key'];
        $_SESSION['user']['albato_key'] = $query_to_update_urls['albato_key'];

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function SaveUserSettings() {
        $user = $this->user->getCurrentUser();


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
                    $this->user->UpdateQuery("user", ["password" => $password], "WHERE id = " . $_SESSION['user']['id']);
                    $this->notifications_class->addNotifications("Пароль изменён", "Вы изменили пароль в {$this->date}", "/img/Notification/message.svg",'item-lite' ,$_SESSION['user']['id']);
                }
            } else {
                $request = "Неверный пароль";
            }
        }

        $data = [
            "first_name" => $first_name,
            "second_name" => $second_name
        ];
        $this->user->UpdateQuery("user", $data, "WHERE id = " . $_SESSION['user']['id']);

        $_SESSION["user"]['first_name'] = $first_name;

        $_SESSION["user"]['second_name'] = $second_name;

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function SaveSocialSettings() {
        $social = $_POST['social'];
        $link = $_POST['link'];

        if ($this->user_contacts->isUserSocials()) {
            $this->user_contacts->UpdateQuery("user_contacts", ["$social" => $link], "WHERE user_id = {$_SESSION['user']['id']}");
        } else {
            $this->user_contacts->InsertQuery("user_contacts", ["$social" => $link, "user_id" => $_SESSION['user']['id']]);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function TakeSocialUrls() {
        echo json_encode($this->user_contacts->TakeSocialUrls());
        return true;
    }

    function AddAdditionally() {
        $this->user_tariff->UpdateQuery("users_tariff", ["clients_add" => $_POST['additionally_user'], "memory_add" => $_POST["additionally_memory"]], "WHERE user_id = {$_SESSION['user']['id']}");
        $this->tariff_class->InsertQuery('tariff_buy_log', ["user_id" => $_SESSION['user']['id'], "money" => 100, "date" => date("Y-m-d", strtotime(mktime(0, 0, 0, date('m'), date('d'), date('Y'))))]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function get_content()
    {
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}