<!DOCTYPE html>

<html lang="ru">

<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Course Creator - Добавить сотрудника</title>
	
	<link rel="stylesheet" href="/css/nullCss.css">
	<link rel="stylesheet" href="/css/auth.css">
	<link rel="stylesheet" href="/css/main.css">
	<!--Favicon-->
	<link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>

<div class="error display-none">
	<?php print_r($_SESSION['error']) ?>
</div>

<div class="app" style="background: #5A6474;">
	
	<?php include 'Admin/layouts/sidebar.php';?>
	
	<div class="adduser" style="display: flex; justify-content: center; align-items: center; width: 100%;">
		
		<form action="/AdminController/AddUser" method="POST" style="display: flex; justify-content: center">
			<h3>Добавить пользователя</h3>
			
			<div class="login-inputs">
				<div class="input_focus">
					<label for="name" class="label_focus">Имя</label>
					<input required type="text" name="name" autocomplete="off">
					<span class="clear_input_val">
                    <img src="/img/clear_input.svg" alt="">
                </span>
				</div>
				<div class="input_focus">
					<label for="username" class="label_focus">Логин</label>
					<input required type="text" name="username" autocomplete="off">
					<span class="clear_input_val">
                    <img src="/img/clear_input.svg" alt="">
                </span>
				</div>
				<div class="input_focus">
					<label for="password" class="label_focus">Пароль</label>
					<input required type="password" name="password" autocomplete="off">
					<span class="clear_input_val">
                    <img src="/img/clear_input.svg" alt="">
                </span>
				</div>
			</div>
            <div class="select-account social-network">
                <div id="myMultiselect" class=" multiselect">
                    <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                        <select name="job" required class="form-select choose-niche">
                            <option id="name">Должность</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div class="mySelectOptions">
                        <label class="item">Сотрудник<input class="custom-checkbox" type="radio" data-value="Сотрудник" value="1" /></label>
                        <label class="item">Руководитель<input class="custom-checkbox" type="radio" data-value="Руководитель" value="2" /></label>
                    </div>
                </div>
            </div>
			
			<button class="reg__button" type="submit" id="submit">Добавить</button>
		</form>
	</div>

</div>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/customSelect.js"></script>
<script>

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

</body>
</html>
