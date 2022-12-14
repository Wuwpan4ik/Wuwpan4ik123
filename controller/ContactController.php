<?php
class ContactController extends ACoreCreator {
	
	public function SendQuestion() {
        $uid = $_SESSION["user"]["id"];
        $author_id = $_POST['author_id'];
        $question = $_POST["question"];
        $user = $this->m->db->query("SELECT * FROM user WHERE id = " . $uid);
        $author_user = $this->m->db->query("SELECT * FROM user WHERE id = " . $author_id);
        $this->m->db->execute("INSERT INTO contact (`user_id`, `author_id`, `body`) VALUES ('$uid', '$author_id', '$question')");
        $this->addNotifications("item-like",  "Пользователь" . $user[0]['first_name'] . " оставил вам вопрос на почте", '/img/Notification/message.png', $author_id);
        $title = "Вопрос от пользователя " . $user[0]['email'];
        $body = "Пользователь.<br>Имя: " . $user[0]['first_name'] . "<br>Email: " . $user[0]['email'] . "<br>Вопрос: $question<br> <a href=\"". $user[0]['email'] ."\">Написать письмо</a>";
        $this->SendEmail($title, $body, $author_user[0]['email']);
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
							window.location.replace("/");
						</script>
					</body>
					</html>';
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}