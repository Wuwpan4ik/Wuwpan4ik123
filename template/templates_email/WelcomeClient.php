<?php
return '
        <html lang="RU">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
                <div class="envelope-container" style="max-width: 500px;
                width: 100%;
                margin: 0 auto;">
                    <div class="envelope-body" style="background:white;">
                        <div class="first_row">
                            <img style="width:100%;" src="https://app.course-creator.io/envelope-images/envelope-welcome.jpg" alt="Добро пожаловать в Course Creator!">
                        </div>
                        <div class="second_row" style="padding:40px;">
                            <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
            Добро пожаловать в Сourse Сreator
                            </h2>
                            <span style="color: rgba(0, 0, 0, 0.6);font-size:16px;font-weight:400;">
            Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                            </span>
                            <div class="info_account" style="margin-top: 30px;">
                                <div class="first_row" style="width:100%;">
                                    <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
            Ваш логин:
                                    </p>
                                    <div style="color: #8098AB;background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
            '.  $res[0]['username'] .'
                                    </div>
                                </div>
                            </div>
                            <div class="link_account" style="margin-top: 20px;">
                                <a href="https://course-creator.io/UserLogin" target="_blank">
                                    <button style="width:100%; height:48px;border:none;font-size:16px;border-radius: 10px;background: linear-gradient(299.36deg, rgba(55, 101, 223, 0.93) 0%, rgba(100, 162, 255, 0.96) 100%);color:white;cursor: pointer;">
            Перейти в аккаунт
        </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                        <div style="font-size:12px;">
            Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
