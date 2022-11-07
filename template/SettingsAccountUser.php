<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="css/nullCss.css">
    <link rel="stylesheet" href="css/main.css">

    <link rel="stylesheet" href="css/settingsAccountUser.css">
    <link rel="stylesheet" href="css/UserMenu.css">



</head>

<body class="body">
<div class="settingsAccountUser bcg">
    <div class="_container">
        <div class="User-header">
            <div class="User-logo user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Центр Ратнера</div>
            </div>
            <div class="header-white__burger">
                <a href="?option=UserMenu">
					<div class="white__burger">
						<span></span>
					</div>
				</a>
            </div>
        </div>
    </div>
    <div class="popup__container">
        <div class="settingsAccountUser-body userPopup">
			<form method="POST" action="?option=AccountController&method=saveUserSettings">
				<div class="settingsAccountUser-body__info userPopup__title">
					Настройки аккаунта:
				</div>
				<div class="userPopup__body">
					<div class="settingsAccountUser-body__info ">
						Информация о вас: 
						<?php if(isset($_SESSION['error']['first_name_message'])) echo $_SESSION['error']['first_name_message'] ?>
						<?php if(isset($_SESSION['error']['second_name_message'])) echo $_SESSION['error']['second_name_message'] ?>
					</div>
					<div class="settingsAccountUser-body__infAbU ">
						<div class="settingsAccountUser-body__infAbU-name userPopup__input">
							<input type="text" placeholder="<?=$_SESSION["user"]["first_name"]?>" name="first_name">
							<span>Ваше имя</span>
						</div>
						<div class="settingsAccountUser-body__infAbU-surname userPopup__input">
							<input type="text" placeholder="<?=$_SESSION["user"]["second_name"]?>" name="second_name">
							<span>Ваша Фамилия</span>
						</div>
					</div>
					<div class="settingsAccountUser-body__pssword ">
						Ваш пароль:
						<?php if(isset($_SESSION['error']['pass_message'])) echo $_SESSION['error']['pass_message'] ?>
					</div>
					<div class="settingsAccountUser-body__newPassword ">
						<div class="settingsAccountUser-body__infAbU-name userPopup__input">
							<input type="password" placeholder="Введите старый пароль" name="old_pass">
						</div>
						<div class="settingsAccountUser-body__infAbU-surname userPopup__input">
							<input type="password" placeholder="Введите новый пароль" name="new_pass">
						</div>
						<div class="settingsAccountUser-body__infAbU-surname userPopup__input">
							<input type="password" placeholder="Повторите новый пароль" name="new_pass_repeat">
						</div>
					</div>
				</div>
				<div class="userPopup__button">
					<button>Сохранить</button>
				</div>
			</form>
           </div>
>>>>>>> 3dae2fb27a54f18027618e41abb4c74640fe6936
    </div>

</div>

</div>
</body>
</html>
