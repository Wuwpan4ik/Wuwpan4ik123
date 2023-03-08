<?php
    $result = '
        <html lang="RU">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="padding:0px;margin:0px;max-width: 800px;font-family: Verdana, Geneva, Tahoma, sans-serif;background: #EFEFEF;">
            <style>
                td, th{
                    font-size: 16px;
        font-weight: 400;
        color: #666666;
                    padding:10px 0px;
                }
            </style>
            <div class="envelope-container" style="max-width: 500px;
            width: 100%;
            margin: 0 auto;">
                <div class="envelope-body" style="background:white;">
                    <div class="first_row">
                        <img style="width:100%;" src="https://app.course-creator.io/envelope-images/envelope-zayavka.jpg" alt="Добро пожаловать в Course Creator!">
                    </div>
                    <div class="second_row" style="padding:40px;">
                        <h2 style="font-size:24px;font-weight: 400;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;">
                            Поздравляем, у вас купили курс!
                        </h2>
                        <span style="color: #666666;font-size:16px;font-weight:400;">
                            Спасибо, что вы зарегистрировались в Сourse Сreator! Ниже важная информация о вашем аккаунте. Пожалуйста, сохраните это письмо, чтобы можно было обратиться к нему позже.
                        </span>
                        <div class="info_account" style="display:-webkit-box;
                        display:-ms-flexbox;
                        display:flex;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;gap: 20px;margin-top: 40px;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;">
                            <div class="whereFrom" style="border-bottom: 1px dashed rgba(0, 0, 0, 0.2);border-top: 1px dashed rgba(0, 0, 0, 0.2);width:100%;padding-top:30px;padding-bottom: 30px;">
                                
                                <table style="width:100%;margin-bottom: 30px;
                                background: #EFF3F6;
                                border-radius: 10px;
                                padding: 10px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:start;width:76px;">
                                                <img src="https://course-creator.io/envelope-images/envelope-zayavka.jpg" alt="Название курса" width="76px" height="100px" style="object-fit: cover;object-position:center;border-radius:6px">
                                            </th>
                                            <th style="width:10px;"></th>
                                            <th style="text-align:start;">
                                                <span style="width:20px;height:20px;text-align:center;background: #4DAA21;color:white;font-size:10px;font-weight:500;padding-top:4px;padding-bottom:4px;padding-right:6px;padding-left:6px;text-align: center;border-radius: 10px;">
                                                    Курс
                                                </span>
                                                <span style="font-size:10px;font-weight:300;margin-left:9px;">
                                                    '. $course_count .' урока
                                                </span>
                                                <br>
                                                <p style="font-size: 14px;
                                                color: #666666;
                                                margin-top: 11px;">
                                                    '. $name .'
                                                </p>
                                            </th>
                                            <th style="text-align: end;width:70px;">
                                                <p style="font-size:10px;font-weight:300;color: #666666;">
                                                    Стоимость заказа
                                                </p>
                                                <span style="font-size:14px;font-weight:500;color: #666666;margin-top:11px;">
                                                    '. "{$cost}  {$currency}" . '
                                                </span>';
                                            if ($number_funnel) { $result .= '
                                                Откуда заявка:
                                            </th >
                                            <th style = "width:100px" ></th >
                                            <th style = "text-align:end;width:50%" >
                                                    Воронка №' . $number_funnel;
                                                }
                        $result .='
                                            </th>
                                        </tr>
                                    </thead>';
                        if (!is_null($number_slide)) {
                            $result .= '
                                        <tbody>
                                            <tr>
                                                <th style="text-align:start" scope="row">
                                                    На каком слайде:
                                                </th>
                                                <td style="width:100%">
                                                    
                                                </td>
                                                <td style="text-align:end">
                                                    Слайд №'. $number_slide .'
                                                </td>
                                            </tr>
                                        </tbody>';
                        }
                        $result .= '
                                    </table>
                                    <table style="width:100%;border-top:1px dashed rgba(0, 0, 0, 0.2);margin-top:30px;padding-top: 20px;padding-bottom: 0px;">
                                    ';
                        if (!is_null($user_name)) {
                            $result .= '
                                        <thead>
                                        <tr>
                                            <th style="text-align:start">
                                                Имя:
                                            </th>
                                            <td style="width:100px">
                                                
                                            </td>
                                            <td style="text-align:end">
                                                '. $user_name .'
                                            </td>
                                        </tr>
                                    </thead>';
                        };
                        $result .= '<tbody>';
                        if (!is_null($phone)) {
                            $result .= '
                                                                <tr>
                                                                    <th style="text-align:start" scope="row">
                                                                        Телефон:
                                                                    </th>
                                                                    <td style="width:100%">
                                    
                                                                    </td>
                                                                    <td style="text-align:end">
                                                                        '. $phone .'
                                                                    </td>
                                                                </tr>';
                        };
                        $result .= '
                                                                <tr>
                                                                    <th style="text-align:start" scope="row">
                                                                        Email:
                                                                    </th>
                                                                    <td style="width:100%">
                                                                        
                                                                    </td>
                                                                    <td style="text-align:end">
                                                                        '. $email .'
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="link_account" style="margin-top:30px;">
                                                    <div class="first_row" style="width:100%">
                                                        <p style="font-weight:700;font-size:14px;margin-top: 0px;margin-left:0px;margin-bottom: 20px;margin-right: 0px;color: rgba(0, 0, 0, 0.9);">
                                                            Смотрите другие заявки на сайте:
                                                        </p>
                                                        <div style="background: #EFF3F6;border-radius: 3px;padding-top: 15px;padding-bottom: 15px;padding-right: 20px;padding-left: 20px;">
                                                            <a href="https://course-creator.io/" target="_blank" style="color: #8098AB;">
                                                                https://course-creator.io/
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="envelope_info_bottom" style="text-align: center;margin-top:20px;margin-bottom: 20px;">
                                                    <div>
                                                        Если у вас есть вопросы, пожалуйста, напишите <br> в службу поддержки: <a href="mailto:support@course-creator.io">support@course-creator.io</a>
                                                    </div>
                                                </div>
                                                </div>
                                            </body>
                                            </html>';
                        return $result;