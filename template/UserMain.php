<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/settingsAccountUser.css">
    <link rel="stylesheet" href="/css/UserMenu.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/smallPlayer.css">
=======
    <link rel="stylesheet" href="css/nullCss.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/settingsAccountUser.css">
    <link rel="stylesheet" href="css/UserMenu.css">
    <link rel="stylesheet" href="css/UserMain.css">
    <link rel="stylesheet" href="css/smallPlayer.css">
>>>>>>> 3dae2fb (setted user menu)



</head>

<body class="body">
<div class="UserMain bcg">
    <div class="_container">
<<<<<<< HEAD

=======
>>>>>>> 3dae2fb (setted user menu)
        <div class="User-header">
            <div class="User-logo user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Центр Ратнера</div>
            </div>
            <div class="header-main__burger">
                <div class="main__burger">
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="popup__container">
<<<<<<< HEAD
        <div class=" aboutTheAuthor userPopup active ">
            <div class="aboutTheAuthor userPopup__title">
                Выберите автора:
            </div>
            <div class="aboutTheAuthor userPopup__body">
                <div class="  popup__allLessons-body">
=======
       <!-- <div class=" aboutTheAuthor userPopup">
            <div class="aboutTheAuthor userPopup__title">
                Выберите автора:
            </div>
            <div class="userPopup__body">
                <div class="popup__allLessons-body">
>>>>>>> 3dae2fb (setted user menu)
                        <div class="popup__allLessons-item ">
                            <div class="popup__allLessons-item__header">
                                <div class="popup-item">
                                    <div class="popup__allLessons-item-video">
                                        <div class="popup__allLessons-item-video-play">
                                            <img src="../img/smallPlayer/play.png" alt="">
                                        </div>
                                        <img src="../img/smallPlayer/Group1426.png" alt="">
                                    </div>
                                    <div class="popup__allLessons-item-info">
                                        <div class="popup__allLessons-item-info-header">
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number">
                                                Автор
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                Сергей Ратнер
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            Управление гневом внутри себя
                                        </div>
                                    </div>
                                </div>
                                <div class="aboutTheAuthor-button">
                                    <button>Вам доступны 2 курса</button>
                                </div>
                            </div>
                        </div>
                        <div class="popup__allLessons-item ">
                        <div class="popup__allLessons-item__header">
                            <div class="popup-item">
                                <div class="popup__allLessons-item-video">
                                    <div class="popup__allLessons-item-video-play">
                                        <img src="../img/smallPlayer/play.png" alt="">
                                    </div>
                                    <img src="../img/smallPlayer/Group1426.png" alt="">
                                </div>
                                <div class="popup__allLessons-item-info">
                                    <div class="popup__allLessons-item-info-header">
                                        <div class=" aboutTheAuthor popup__allLessons-item-info-header-number">
                                            Автор
                                        </div>
                                        <div class="aboutTheAuthor-name">
                                            Сергей Ратнер
                                        </div>
                                    </div>
                                    <div class="popup__allLessons-item-info-title">
                                        Управление гневом внутри себя
                                    </div>
                                </div>
                            </div>
                            <div class="aboutTheAuthor-button">
                                <button>Вам доступны 2 курса</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>/-->
        <div class=" availableToYou main userPopup">

       <div class="availableToYou userPopup__title">
           Вам доступны:
       </div>
       <div class="availableToYou userPopup__body">
           <div class=" availableToYou ">
		   <?php

					foreach($content[0] as $p){
						foreach($content[2] as $det){
							if($det["course_id"] == $p["id"]){?>

				<div class="availableToYou__body">
					   <div class="popup__allLessons-item ">
						   <div class="popup__allLessons-item__header">

                                    <?foreach($content[1] as $v){
                                            if ($v['course_id'] == $p['id']) {?>

							   <div class="popup-item">
								   <div class="popup__allLessons-item-video">
											<div class="popup__allLessons-item-video-play">
											   <img src="../img/smallPlayer/play.png" alt="">
										   </div>
										   <video src="<?=$v['video']?>" alt=""/>
										</div>
									   <div class="popup__allLessons-item-info">
										   <div class="popup__allLessons-item-info-header">
											   <div class=" aboutTheAuthor popup__allLessons-item-info-header-number">
												   Курс
											   </div>
											   <div class="aboutTheAuthor-name">
												   22 урока
											   </div>
										   </div>
										   <div class="popup__allLessons-item-info-title">
											   <?=$p["name"]?>
										   </div>
									   </div>
								   </div>
									<?}}?>
							   </div>
						   </div>
					   </div>
							<?}else{

							}}}?>
				   								   
					<div class="otherСourses">
                   <div class=" otherСourses userPopup__title">
                       Другие курсы автора:
                   </div>
                   <div class="otherСourses userPopup__body">
                       <div class="otherСourses ">
					   <?php
								foreach($content[0] as $op){?>
							
                           <div class="popup__allLessons-item ">
                               <div class="popup__allLessons-item__header">
							   
							   <?foreach($content[1] as $v){
                                            if ($v['course_id'] == $op['id']) {?>
							   
                                   <div class="popup-item">
                                       <div class="popup__allLessons-item-video">
                                           <div class="popup__allLessons-item-video-play">
                                               <img src="../img/smallPlayer/play.png" alt="">
                                           </div>
                                           <video src="<?=$v['video']?>" alt=""/>
                                       </div>
                                       <div class="popup__allLessons-item-info">
                                           <div class="popup__allLessons-item-info-header">
                                               <div class=" aboutTheAuthor popup__allLessons-item-info-header-number">
                                                   Курс
                                               </div>
                                               <div class="aboutTheAuthor-name">
                                                   22 урока
                                               </div>
                                           </div>
                                           <div class="popup__allLessons-item-info-title">
                                               <?=$op["name"]?>
                                           </div>
                                       </div>
                                   </div>
							   <?}}?>
                               </div>
                           </div>
						   
							<?}?>

                       </div>
                   </div>
                   <div class="otherСourses userPopup__button">
                       <button>Есть вопросы?</button>
                   </div>
               </div>

       </div>
   </div>
</div>





</div>
<!--        <div class="popup__container">-->
<!--            <div class="userPopup">-->
<!--                <div class="aboutTheAuthor userPopup__title">-->
<!--                    Выберите автора::-->
<!--                </div>-->
<!--                <div class="userPopup__body">-->
<!--                    <div class="UserNotifications-cards">-->
<!--                    </div>-->
<!--                    <div class="userPopup__button">-->
<!--                        <button>Есть вопросы?</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
</body>
</html>