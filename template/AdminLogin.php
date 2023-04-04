<!DOCTYPE html>

<html lang="ru">

<head>
	
	<meta charset="UTF-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/css/nullCss.css">
	<link rel="stylesheet" href="/css/auth.css">
	
	<title>Course Creator - Вход</title>
	<!--Favicon-->
	<link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">

</head>

<body>
<div class=" login-account container-reg">
	
	<form class="login__form" method="POST" action="/AdminController/Login">
		<div class="reg-logo">
			<img src="../img/regLogo.jpg" alt="">
		</div>
		<h3>Панель администрации</h3>
		
		<div class="login-inputs">
			<div class="input_focus">
				<label for="login" class="label_focus">Ваш логин</label>
				<input type="text" name="username" autocomplete="off">
				<span class="clear_input_val">
                    <img src="/img/clear_input.svg" alt="">
                </span>
			</div>
			<div class="input_focus">
				<label for="pass" class="label_focus">Ваш пароль</label>
				<input type="password" name="password" autocomplete="off">
				<span class="clear_input_val">
                    <img src="/img/clear_input.svg" alt="">
                </span>
			</div>
		</div>
		
		<div class="display-flex error">
		</div>
		
		<button class="reg__button" type="submit" id="submit">Войти</button>
	</form>
	
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
                            window.location.replace('/admin');
                        },
                        error: function (data) {
                            document.querySelector(".error").innerHTML = "<img src='/img/Login/warning.svg' width='20px;' height='20px;'>" + data.responseText;
                            document.querySelector(".error").style.margin = "22px 0px 0px 0px";
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
                inputs[i].addEventListener('focusin', function(){
                    inputsLabel[i].classList.add('activeLabel');
                })
                inputs[i].addEventListener('focusout', function(){
                    if(inputsLabel[i].classList.contains('activeLabel') && inputs[i].value != ""){
                        return;
                    }else{
                        inputsLabel[i].classList.remove('activeLabel');
                    }
                })
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
</div>
</body>

</html>
