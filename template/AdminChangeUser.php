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
  
		<form action="/AdminController/ChangeUser" method="POST" style="display: flex; justify-content: center">
            <h3><?php if ($content['user']) { ?>Изменить данные<?php } else { ?>Добавить данные<?php } ?></h3>
			<div class="login-inputs">
				<?php if ($content['user']) { ?>
                    <input type="text" name="user_id" value="<?=$_SESSION['item_id'] ?>" hidden>
				<?php } else { ?>
                    <div class="select-account social-network">
                        <div id="myMultiselect" class=" multiselect">
                            <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                                <select name="user_id" required class="form-select choose-niche">
                                    <option id="name">Пользователь</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div class="mySelectOptions">
                                <?php foreach ($content['users'] as $item) { ?>
                                    <label class="item"><?php echo $item['id'] . ' - ' . $item['username'] ?><input class="custom-checkbox" type="radio" data-value="<?php echo $item['id'] . ' - ' . $item['first_name'] ?>" value="<?=$item['id']?>" /></label>
	                            <?php } ?>
                            </div>
                        </div>
                    </div>
				<?php } ?>
				<div class="input_focus">
					<label for="date_start" class="label_focus activeLabel has_content">Начальная дата</label>
					<input type="date" name="date_start" required value="<?php if ($content['user']['date_start']) echo $content['user']['date_start']?>" autocomplete="off">
					<span class="clear_input_val">
                    <img src="/img/clear_input.svg" alt="">
                </span>
				</div>
				<div class="input_focus">
					<label for="date" class="label_focus activeLabel has_content">Конечная дата</label>
					<input type="date" name="date" required value="<?php if ($content['user']['date']) echo $content['user']['date']?>" autocomplete="off">
					<span class="clear_input_val">
                    <img src="/img/clear_input.svg" alt="">
                </span>
				</div>
                <div class="select-account social-network">
                    <div id="myMultiselect" class=" multiselect">
                        <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea(this)">
                            <select name="tariff" required class="form-select choose-niche">
                                <option id="name"><?php if ($content['user']['name']) { echo htmlspecialchars($content['user']['name']);}else {echo "Тариф";}?></option>
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        <div class="mySelectOptions">
                            <label class="item">Starter<input class="custom-checkbox" type="radio" data-value="Starter" value="1" /></label>
                            <label class="item">Beginner<input class="custom-checkbox" type="radio" data-value="Beginner" value="2" /></label>
                            <label class="item">Proffesional<input class="custom-checkbox" type="radio" data-value="Proffesional" value="3" /></label>
                        </div>
                    </div>
                </div>
			</div>
			
			<button class="reg__button" type="submit" id="submit">Добавить</button>
		</form>
	</div>

</div>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/customSelect.js"></script>
<!--<script src="/js/customInputs.js"></script>-->
<script>
    <?php if ($content['user']['name']) { ?>
    document.querySelector('input[data-value="<?php echo $content['user']['name']?>"]').click()
    <?php } ?>
</script>
<script>
    // window.onload = () =>{
    //     let inputs = document.querySelectorAll('.input_focus input');
    //     let inputsLabel = document.querySelectorAll('.input_focus label');
    //     let inputClear = document.querySelectorAll('.input_focus span');
    //
    //
    //     for(let i =0; i < inputs.length; i++){
    //         inputs[i].addEventListener('focusin', function(){
    //             inputsLabel[i].classList.add('activeLabel');
    //         })
    //         inputs[i].addEventListener('focusout', function(){
    //             if(inputsLabel[i].classList.contains('activeLabel') && inputs[i].value != ""){
    //                 return;
    //             }else{
    //                 inputsLabel[i].classList.remove('activeLabel');
    //             }
    //         })
    //         inputs[i].addEventListener('input', function(){
    //             if(inputs[i].value != ""){
    //                 inputsLabel[i].classList.add('activeLabel');
    //                 inputClear[i].classList.add('has_content');
    //             }
    //             else {
    //                 inputsLabel[i].classList.remove('activeLabel');
    //                 inputClear[i].classList.remove('has_content');
    //             }
    //         });
    //
    //         inputClear[i].onclick = () =>{
    //             inputsLabel[i].classList.remove('activeLabel')
    //             inputs[i].value = "";
    //             inputClear[i].classList.remove('has_content')
    //         }
    //     }
    // }
</script>

</body>
</html>
