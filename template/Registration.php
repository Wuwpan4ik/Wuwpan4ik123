<!DOCTYPE html><html lang="en"><head>    <meta charset="UTF-8">    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <link rel="stylesheet" href="css/auth.css">	<link rel="stylesheet" href="css/profilesetting.css">    <title>Document</title></head><body>    <form method="POST" action="?option=LoginController&method=registration" enctype="multipart/form-data">        <h3>Создание аккаунта</h3>        <? echo $_SESSION['error']['registration_message']?>		<input required placeholder="Ваше имя" type="text" name="first_name">		<div class="choose">            <input style="display:none;" id="M" name="gender" type="radio"/>			<label for="M"><span class="dot"></span></label>Мужской            <input style="display:none;" id="W" name="gender" type="radio"/>			<label for="W"><span class="dot"></span></label>Женский        </div>		<div>			<p>Выберите вашу нишу</p>			<select required name="niche">				<option>Изотерика</option>				<option>Обучение</option>				<option>Дизайн</option>				<option>Политика</option>				<option>Спорт</option>				<option>Игры</option>				<option>Животные</option>			</select>		</div>		<div>			<input id="ava" type="file" name="avatar"/>			<label class="ava_choose" for="ava">Выберите свой аватар</label>		</div>        <input required placeholder="Ваш Email" type="email" name="email">        <input required placeholder="Ваш пароль" type="password" name="pass">        <input type="submit" id="submit">        <a href="?option=Login">Есть аккаунт?</a>    </form>    <? unset($_SESSION['error']) ?></body></html>