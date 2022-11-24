<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/auth.css">

    <title>Document</title>

</head>

<body>
<div class="login-account container-reg">

    <form method="POST" action="/LoginController/login">
        <div class="reg-logo">
            <img src="../img/regLogo.jpg" alt="">
        </div>
        <h3>Восстановление пароля</h3>

        <input placeholder="Ваш email" type="email" name="email">



        <button class="reg__button" type="submit" id="submit">Войти</button>
        <div class="entrance login-footer">
            <a href="/reg">Зарегистрироваться</a>
            <a href="/login">Забыли пароль?</a>
        </div>
    </form>
</div>
</body>

</html>
