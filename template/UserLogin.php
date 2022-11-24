<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">

</head>

<body>
    <div class="userLogin">
        <div class="userLogin-body _container">
            <div class="user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Центр Ратнера</div>
            </div>
            <div class="userLogin-popup popup">
                <div class="userLogin-popup__subtitle popup__subtitle">
                    Добро пожаловать в
                </div>
                <div class="userLogin-popup__title popup__title">
                    Войдите в аккаунт
                </div>
                <div class="userLogin-form popup-form">
					<form method="POST" action="/LoginController/login">
                        <input type="hidden" value="true" name="userLogin">
						<div class="userLogin-email inputLog">
							<input placeholder="Ваш Email" type="email" name="email">
						</div>
						<div class="userLogin-password inputLog">
							<input placeholder="Введите пароль" type="password" name="pass">
						</div>
						<div class="button-send ">
							<input type="submit" id="apps">
						</div>
					</form>
                </div>

            </div>
            <div class="user-text">
                <a href="/UserRecovery">Восстановление пароля</a>
            </div>
        </div>

    </div>
</body>
</html>