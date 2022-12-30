<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Course Creator - Вход</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>
    <div class="userLogin">
        <div class="userLogin-body _container">
            <div class="user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Course Creator</div>
            </div>
            <div class="userLogin-popup popup">
                <div class="userLogin-popup__subtitle popup__subtitle">
                    Добро пожаловать
                </div>
                <div class="userLogin-popup__title popup__title">
                    Войдите в аккаунт
                </div>
                <div class="userLogin-form popup-form">
					<form method="POST" class="login__form" action="/LoginController/UserLogin">
                        <input type="hidden" value="true" name="userLogin">
                        <div class="input_focus inputLog">
                            <label for="email" class="label_focus">Ваша почта</label>
                            <input type="email" name="email">
                            <span class="clear_input_val">
                                <img src="/img/clear_input.svg" alt="">
                            </span>
                        </div>

                        <div class="input_focus inputLog">
                            <label for="pass" class="label_focus">Введите пароль</label>
                            <input type="password" name="pass">
                            <span class="clear_input_val">
                                <img src="/img/clear_input.svg" alt="">
                            </span>
                        </div>
						<div class="button-send ">
							<input type="submit" id="apps" value="Вход">
						</div>
					</form>
                </div>

            </div>
            <div class="user-text">
                <a href="/UserRecovery">Восстановление пароля</a>
            </div>
        </div>

    </div>
    <!--For Input Holders-->
    <script src="/js/jquery-3.6.1.min.js"></script>
    <script>
        let form__submit = $(function() {
            $('.login__form').each(function () {
                $(this).submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr("action"),
                        type: $(this).attr("method"),
                        data: $(this).serialize(),
                        success: function (data) {
                            window.location.replace('/');
                        },
                        error: function (data) {
                            document.querySelector(".error").innerHTML = data.responseText;
                        }
                    });
                })
            });
        });
    </script>
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