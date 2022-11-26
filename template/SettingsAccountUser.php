<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Creator - Редактирование аккаунта</title>
    <link rel="stylesheet" href="/css/nullCss.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/UserMain.css">
</head>

<body class="body">
<div class="settingsAccountUser bcg">
    <div class="_container">
        <div class="User-header">
            <div class="User-logo user__logo">
                <div class="user__logo-img"><img src="../img/Logo.svg" alt=""></div>
                <div class="user__logo-text">Course Creator</div>
            </div>
            <div class="header-white__burger">
                <a href="/UserMenu">
                    <div class="main__burger">
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="popup__container">
        <div class="settingsAccountUser-body userPopup">
            <div class="user-content">
                <form method="POST" action="/Account/UserSettings" class="user_settings">
                    <div class="menu_first">
                        <div class="settingsAccountUser-body__info userPopup__title">
                            Настройки аккаунта:
                        </div>
                        <div class="userPopup__body">
                            <div class="settingsAccountUser-body__info ">
                                Информация о вас:
                                <?php if(isset($_SESSION['error']['first_name_message'])) echo $_SESSION['error']['first_name_message'] ?>
                                <?php if(isset($_SESSION['error']['second_name_message'])) echo $_SESSION['error']['second_name_message'] ?>
                            </div>
                            <div class="settingsAccountUser-body__infAbU">
                                <div class="input_focus inputLog">
                                    <label for="first_name" class="label_focus">Ваше имя</label>
                                    <input type="text" name="first_name">
                                    <span class="clear_input_val">
                                        <img src="/img/clear_input.svg" alt="">
                                    </span>
                                </div>
                                <div class="input_focus inputLog">
                                    <label for="second_name" class="label_focus">Ваша фамилия</label>
                                    <input type="text" name="second_name">
                                    <span class="clear_input_val">
                                        <img src="/img/clear_input.svg" alt="">
                                    </span>
                                </div>
                            </div>
                            <div class="settingsAccountUser-body__pssword ">
                                Ваш пароль:
                                <?php if(isset($_SESSION['error']['pass_message'])) echo $_SESSION['error']['pass_message'] ?>
                            </div>
                            <div class="settingsAccountUser-body__newPassword ">
                                <div class="input_focus inputLog">
                                    <label for="old_pass" class="label_focus">Введите старый пароль</label>
                                    <input type="password" name="old_pass">
                                    <span class="clear_input_val">
                                        <img src="/img/clear_input.svg" alt="">
                                    </span>
                                </div>
                                <div class="input_focus inputLog">
                                    <label for="new_pass" class="label_focus">Введите старый пароль</label>
                                    <input type="password" name="new_pass">
                                    <span class="clear_input_val">
                                        <img src="/img/clear_input.svg" alt="">
                                    </span>
                                </div>
                                <div class="input_focus inputLog">
                                    <label for="new_pass" class="label_focus">Повторите новый пароль</label>
                                    <input type="password" name="new_pass_repeat">
                                    <span class="clear_input_val">
                                        <img src="/img/clear_input.svg" alt="">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="second_menu">
                        <div class="userPopup__button">
                            <button>Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
