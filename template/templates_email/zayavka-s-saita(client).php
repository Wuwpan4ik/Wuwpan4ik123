<?php
$result = '<html lang="RU">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
    <div class="envelope-container" style="max-width:500px;margin:0 auto;width:100%;">
        <div class="envelope-body" style="background:white;">
            <div class="first_row">
                <img style="width:100%;" src="https://app.course-creator.io/envelope-images/envelope-zayavka.jpg" alt="Добро пожаловать в Course Creator!">
            </div>
            <div class="second_row" style="padding:40px 20px;">
                <div class="info_account" style="margin-top: 40px;">
                    <div class="second_row">
                        <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
                            Вам пришла заявка!
                        </h2>
                        <span style="color: rgba(0, 0, 0, 0.6);font-size:16px;font-weight:400;">
                                                    Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                                                </span>
                        <table style="width:100%;margin-top: 40px;border-bottom: 1px dashed rgba(0, 0, 0, 0.2);border-top: 1px dashed rgba(0, 0, 0, 0.2);width:100%;padding-top:30px;padding-bottom: 30px;">
                            <thead>
                            <tr>
                                <th style="text-align:start;">
                                    Откуда заявка:
                                </th>
                                <th>

                                </th>
                                <th style="text-align: end;">
                                    '. $name_funnel .'
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align:start;">
                                    На каком слайде:
                                </th>
                                <th>

                                </th>
                                <th style="text-align: end;">
                                    Слайд №'. $number_slide .'
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <table style="width:100%;padding-bottom:20px;padding-top:20px;border-bottom: 1px dashed rgba(0, 0, 0, 0.2);margin-bottom:30px;">
                            <thead>
                            <tr>
                                <th style="text-align:start;">
                                    Email:
                                </th>
                                <th>

                                </th>
                                <th style="text-align: end;">
                                    '. $email .'
                                </th>
                            </tr>';
                            if (!is_null($name)) {
                            $result .= '
                            <tr>
                                <th style="text-align:start;">
                                    Имя:
                                </th>
                                <th>
                                </th>
                                <th style="text-align: end;">
                                    '. $name .'
                                </th>
                            </tr>
                            ';
                            }
                            if (!is_null($phone)) {
                            $result .= '
                            <tr>
                                <th style="text-align:start;">
                                    Телефон:
                                </th>
                                <th>

                                </th>
                                <th style="text-align: end;">
                                    '. $phone .'
                                </th>
                            </tr>';
                            }

                            $result .= '
                            </thead>
                        </table>
                        <div class="link_account">
                            <div class="first_row" style="width:100%">
                                <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                    Смотрите другие заявки на сайте:
                                </p>
                                <div style="background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                    <a href="https://appp.course-creator.io/" target="_blank" style="color: #8098AB;">
                                        https://appp.course-creator.io/
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                    <div style="font-size:12px;">
                        Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                    </div>
                </div>
            </div>
    </body>';
    return $result;