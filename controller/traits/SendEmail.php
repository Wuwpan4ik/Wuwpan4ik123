<?php
    trait SendEmail {

        function EmailQueueApiCall($messages = false) {
            $curl = curl_init();

            $request = [
                "key" => $this->api_key,
                "messages" => $messages
            ];

            curl_setopt($curl, CURLOPT_URL, $this->api_endpoint);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, ["q" => json_encode($request)]);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            return json_decode($result, true);
        }

        public function SendEmail ($title, $body, $email, $file = null, $file_name = null) {

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->CharSet = "UTF-8";
                $mail->SMTPAuth   = true;
                $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

                // Настройки вашей почты
                $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
                $mail->Username   = $this->ourEmail; // Логин на почте
                $mail->Password   = $this->ourPassword; // Пароль на почте
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
                $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
                );
                $mail->setFrom($this->ourEmail, $this->ourNickName); // Адрес самой почты и имя отправителя

                // Получатель письма
                $mail->addAddress($email);

                $mail->isHTML();
                $mail->Subject = $title;
                $mail->Body = $body;
                if (!is_null($file)) {
                    $mail->addAttachment($file, $file_name);
                }

                if ($mail->send()) {$result = "success";}
                else {$result = "allGood";}

            } catch (Exception $e) {
                $result = $mail->ErrorInfo;
                $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
            }
        }
    }