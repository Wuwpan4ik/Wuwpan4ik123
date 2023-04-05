<!DOCTYPE html>

<html lang="ru">

<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Course Creator - Статистика</title>
	
	<link rel="stylesheet" href="/css/nullCss.css">
	<link rel="stylesheet" href="/css/auth.css">
	<link rel="stylesheet" href="/css/main.css">
	<!--Favicon-->
	<link rel="icon" type="image/x-icon" href="/uploads/course-creator/favicon.ico">
</head>

<body>

<style>
    .nav {
        min-width: auto !important;
    }
    .block {
        display: flex;
        justify-content: space-around;
        gap: 20px;
        flex-wrap: wrap;
        padding: 20px;
    }
    
    .block__item {
        font-size: 20px;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        width: 300px;
        height: 200px;
        padding: 10px;
        background: white;
        color: black;
    }
    
    .block__title {
        display: flex;
        justify-content: center;
    }
    
    .block__count {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        font-size: 28px;
    }
</style>

<div class="error display-none">
	<?php print_r($_SESSION['error']) ?>
</div>

<div class="app" style="background: #5A6474;">
	
	<?php include 'Admin/layouts/sidebar.php';?>
    <div class="container" style="width: 100%">
        <div class="block">
            <div class="block__item">
                <h2 class="block__title">Количество авторов</h2>
                <div class="block__count"><?=$content['count_creator']?></div>
            </div>
            <div class="block__item">
                <h2 class="block__title">Количество авторов без подписки</h2>
                <div class="block__count"><?=$content['count_creator_without_tariff']?></div>
            </div>
            <div class="block__item">
                <h2 class="block__title">Количество пользователей</h2>
                <div class="block__count"><?=$content['count_user']?></div>
            </div>
            <div class="block__item">
                <h2 class="block__title">Количество всех пользователей</h2>
                <div class="block__count"><?=$content['count_all_user']?></div>
            </div>
        </div>
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
