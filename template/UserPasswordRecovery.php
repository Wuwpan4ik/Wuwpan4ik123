<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Creator - Восстановление пароля</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <link rel="stylesheet" href="/css/main.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>
<div class="UserPasswordRecovery">
    <div class="UserPasswordRecovery-body _container">
        <div class="user__logo">
            <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
            <div class="user__logo-text">Course Creator</div>
        </div>
        <div class="UserPasswordRecovery-popup popup">
            <div class="UserPasswordRecovery-popup__subtitle popup__subtitle">
                Забыли пароль?
            </div>
            <div class="UserPasswordRecovery-popup__title popup__title">
                Восстановление пароля
            </div>
            <div class="UserPasswordRecovery-form popup-form">
                <div class="input_focus inputLog">
                    <label for="email" class="label_focus">Ваша почта</label>
                    <input type="email" name="email">
                    <span class="clear_input_val">
                        <img src="/img/clear_input.svg" alt="">
                    </span>
                </div>
                <div class="button-send ">
                    <input type="submit" value="Отправить новый пароль" id="apps">
                </div>
            </div>

        </div>
        <div class="user-text">
            <a href="/UserLogin">Войти</a>
        </div>
    </div>

</div>

<!--For Input Holders-->
<script src="/js/jquery-3.6.1.min.js"></script>
<script>
    window.onload = () =>{
        let inputs = document.querySelectorAll('.input_focus input');
        let inputsLabel = document.querySelectorAll('.input_focus label');
        let inputClear = document.querySelectorAll('.input_focus span');


        for(let i =0; i < inputs.length; i++){
            inputs[i].addEventListener('input', function(){
                if(inputs[i].value != ""){
                    inputsLabel[i].classList.add('activeLabel');
                    inputClear[i].classList.add('has_content');
                }
                else {
                    inputsLabel[i].classList.remove('activeLabel');
                    inputClear[i].classList.remove('has_content');
                }
            });

            inputClear[i].onclick = () =>{
                inputsLabel[i].classList.remove('activeLabel')
                inputs[i].value = "";
                inputClear[i].classList.remove('has_content')
            }
        }
    }
</script>
</body>
</html>
