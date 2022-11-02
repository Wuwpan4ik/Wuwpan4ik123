<div class="feed-header">

    <div class="feed-header__title">
        <?php if($_GET['option'] != 'Main') { ?>
        <a class="button__back" href="/<?=isset($back) ? $back : "Main" ?>">
            <img src="/img/ArrowLeft.svg" alt="">
        </a>
        <?php } ?>
        <h2><?=$title ?></h2>
    </div>

    <div class="buttonsFeed">

        <button class="ico_button button-bell"><img class="ico" src="img/Bell.svg">  <div id="msg">5</div></button>

        <button id="apps" class="ico_button" onclick="window.location.replace('Analytics')">Заявки</button>

    </div>

</div>
