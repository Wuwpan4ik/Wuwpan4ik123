<?phpif(is_null($_SESSION["user"]["first_name"])){?>    <div class="nav">    <div class="sidebar" style="height:88vh;">        <a href="/login">            <div class="sidebarOption" >                <div class="option">                    <img class="ico" src="img/Log.svg">                        <h2>Войти</h2>                </div>            </div>        </a>        <a href="/reg">            <div class="sidebarOption">                <div class="option">                    <img class="ico" src="img/Reg.svg">                        <h2>Зарегистрироваться</h2>                </div>            </div>        </a>    </div>    <div class="contactSignout">        <div class="sidebarOption">            <img class="ico" src="img/Support.svg">            <h2>Поддержка</h2>        </div>    </div></div><?}else{?><div class="nav">    <div class="sidebar">        <div class="UserProfile">            <div class="UserProfile__header">                <img id="avatar" src="/uploads/ava/<? echo (isset($_SESSION['user']['avatar'])  ? $_SESSION['user']['avatar'] : "userAvatar.jpg") ?>"/>                <div class="text-info">                    <p>Добро пожаловать,</p>                    <div class="text-info-name">                        <h1><?=$_SESSION["user"]["first_name"]?></h1>                    </div>                </div>               <div class="UserProfile__header-logo">               </div>                <div>                    <a href="/Account">                        <button class="ico_button"><img class="ico" src="/img/Settings.svg"></button>                    </a>                </div>            </div>        </div>        <a href="/">            <div class="sidebarOption <? if ($_SERVER['REQUEST_URI'] == '/') echo 'active'; ?>" >                    <div class="option">                        <img class="ico" src="/img/Main.svg">                            <h2>Основные показатели</h2>                    </div>            </div>        </a>        <a href="/Project">            <div class="sidebarOption <? if (substr($_SERVER['REQUEST_URI'], 1) == 'Project') echo 'active'; ?>">                    <div class="option">                        <img class="ico" src="/img/Proj.svg">                            <h2>Мои проекты</h2>                    </div>            </div>        </a>        <? if (in_array(explode('/', substr($_SERVER['REQUEST_URI'], 1))[0], ['Funnel', 'Course', 'Project'])) { ?>            <a href="/Funnel">                <div class="sidebarOption sib_sidebar <? if (in_array(explode('/', substr($_SERVER['REQUEST_URI'], 1))[0],  ['Funnel'])) echo 'active'; ?>">                    <div class="option">                        <img class="ico" src="/img/folder-remove.svg">                        <h2>Мои воронки</h2>                    </div>                </div>            </a>            <a href="/Course">                <div class="sidebarOption sib_sidebar <? if (in_array(substr($_SERVER['REQUEST_URI'], 1),  ['Course'])) echo 'active'; ?>">                    <div class="option">                        <img class="ico" src="/img/camera.svg">                        <h2>Мои курсы</h2>                    </div>                </div>            </a>        <? } ?>        <a href="/Analytics">            <div class="sidebarOption <? if (substr($_SERVER['REQUEST_URI'], 1) == 'Analytics') echo 'active'; ?>">                    <div class="option">                        <img class="ico" src="/img/Analytics.svg">                            <h2>Статистика</h2>                    </div>            </div>        </a>        <a href="/Cases">            <div class="sidebarOption <? if (substr($_SERVER['REQUEST_URI'], 1) == 'Cases') echo 'active'; ?>">                    <div class="option">                        <img class="ico" src="/img/Case.svg">                            <h2>Кейсы</h2>                    </div>            </div>        </a>    </div>    <div class="contactSignout">        <div class="sidebarOption">            <div class="option">                <img class="ico" src="/img/Support.svg">                <h2>Поддержка</h2>            </div>        </div>        <a href="/LoginController/logout">            <div class="sidebarOption">                <div class="option">                    <img class="ico" src="/img/Exit.svg">                    <h2>Выход</h2>                </div>            </div>        </a>    </div></div><?}?>