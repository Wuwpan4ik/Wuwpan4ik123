<?php
class ContactController extends ACoreCreator {

    private function GetQuestionHTML($name, $email, $time, $question)
    {
        return '<html lang="RU">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                            <div class="envelope-body" style="background:white;">
                                <div class="first_row">
                                    <img style="width:100%;" src="https://course-creator.io/envelope-images/envelope-zayavka.jpg" alt="Добро пожаловать в Course Creator!">
                                </div>
                                <div class="second_row" style="padding:40px;">
                                    <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
                                        Вам пришло письмо от '. $email .'
                                    </h2>
                                    <div style="color: rgba(0, 0, 0, 0.6);font-size:16px;font-weight:400;background:#EFF3F6; padding-top:12px;padding-bottom: 12px;padding-left: 20px;padding-right: 20px;">
                                        <!--Здесь выводим само обращение, которое написал юзер-->
                                        Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                                    </div>
                                    <div class="info_account" style="display:-webkit-box;
                                    display:-ms-flexbox;
                                    display:flex;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;gap: 20px;margin-top: 20px;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;">
                                        <div class="whom" style="padding-top: 30px;border-top: 1px dashed rgba(0, 0, 0, 0.2);margin-bottom: 0px;">
                                            <div class="person" style="margin-bottom:20px;display:flex; justify-content: space-between">
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    Откуда пришло:
                                                </span>
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    '. $name .'
                                                </span>
                                            </div>
                                            <div class="email" style="margin-bottom:20px;display:flex; justify-content: space-between">
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    От кого пришло:
                                                </span>
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    '. $this->email .'
                                                </span>
                                            </div>
                                            <div class="qiestion" style="margin-bottom:20px;display:flex; justify-content: space-between">
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    Вопрос:
                                                </span>
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    '. $question .'
                                                </span>
                                            </div>
                                            <div class="phone" style="display:flex; justify-content: space-between">
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    Когда пришло:
                                                </span>
                                                <span style="font-size:16px;font-weight:400;color: rgba(0, 0, 0, 0.6);">
                                                    '. date("h:i, d.m.Y") .'
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                                <div>
                                    Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                                </div>
                            </div>
                        </body>
                        </html>';
    }
	
	public function SendQuestion() {

        $uid = $_SESSION["user"]["id"];
        $author_id = $_POST['author_id'];
        $course_id = $_POST['course_id'];
        $question = $_POST["question"];

        $user = $this->m->db->query("SELECT * FROM user WHERE id = " . $uid);
        $author_user = $this->m->db->query("SELECT * FROM user WHERE id = " . $author_id);
        $course = $this->m->db->query("SELECT name FROM course WHERE id = " . $course_id);

        $this->m->db->execute("INSERT INTO contact (`user_id`, `author_id`, `body`) VALUES ('$uid', '$author_id', '$question')");
        $this->addNotifications("item-like",  "Пользователь" . $user[0]['first_name'] . " оставил вам вопрос на почте", '/img/Notification/message.png', $author_id);
        $title = "Вопрос от пользователя " . $user[0]['email'];
        $body = $this->GetQuestionHTML($course[0]['name'], $user[0]['email'], date('Y-m-d H:i:s'), $question);
        $this->SendEmail($title, $body, $author_user[0]['email']);
        $this->addNotifications("item-like", 'Вам задали вопрос по курсу ' . $course[0]['name'], '/img/Notification/message.png', $author_id);
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