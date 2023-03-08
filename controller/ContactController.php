<?php
class ContactController extends ACoreCreator {

    private function GetQuestionHTML($name, $email, $time, $question)
    {
        return include_once "./template/templates_email/est-vopros(client).php";
    }
	
	public function SendQuestion() {

        $uid = $_SESSION["user"]["id"];
        $author_id = $_POST['author_id'];
        $course_id = $_POST['course_id'];
        $question = $_POST["question"];

        $user = $this->user->getUserById();
        $author_user = $this->user->getUserById($author_id);
        $course = $this->course->Get(["id" => $course_id]);

        $this->contact->InsertQuery("contact", ["user_id" => $uid, "author_id" => $author_id, "body" => $question]);
        $this->notifications_class->addNotifications("Вам пришел вопрос от клиента",  "Пользователь {$user[0]['first_name']} оставил вопрос, для ответа свяжитесь с ним по {$user[0]['email']}", '/img/Notification/question.svg','item-lite', $author_id);

        $title = "Вопрос от пользователя " . $user[0]['email'];
        $body = $this->GetQuestionHTML($course[0]['name'], $user[0]['email'], date('Y-m-d H:i:s'), $question);
        $this->SendEmail(
            [
                "from" => "{$this->ourEmail}",
                "to" => "{$author_user[0]['email']}",
                "sender" => "{$this->ourNickName}",
                "subject" => "{$title}",
                "content" => "$body",
                "is_send_now" => 1
            ]
        );
        header("Location: /");
    }

    function get_content()
    {
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}