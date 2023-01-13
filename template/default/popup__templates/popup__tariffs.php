<div class="change-tariff-popup popup-tariff">
    <div class="popup-tariff-body">
        <div class="popup__title">
            Выберите лучшее соотношение цены <br> и возможностей Сourse-creator.io
        </div>

        <div class="popup-tariff__cards">
            <?php foreach ($content[0] as $item) { ?>
            <div class="popup-tariff__card">
                <div class="popup-tariff__card-body">
                    <div class="popup-tariff__subtitle">
                        <?php echo htmlspecialchars($item['name'])?>
                    </div>
                    <p><?php echo htmlspecialchars($item['description'])?></p>
                    <div class="popup-tariff__img">
                        <img src="<?php echo htmlspecialchars($item['image'])?>" alt="">
                    </div>

                    <div class="popup-tariff__info">
                        <ul>
                            <li><?php echo htmlspecialchars($item['funnel_count'])?> воронка (сайт)</li>
                            <li><?php echo htmlspecialchars($item['course_count'])?> курс </li>
                            <li><?php echo htmlspecialchars($item['file_size'])?>  гб места на хостинге</li>
                            <li>до <?php echo htmlspecialchars($item['children_count'])?> учеников</li>
                        </ul>
                    </div>
                    <div class="popup-tariff__price">
                        Стоимость
                        <div class="tariff-price__popup "><?php echo htmlspecialchars($item['price'])?> ₽/ мес </div>
                    </div>
                    <div class="popup-tariff-button">
                        <button class="tariff__button-buy <?php if ($_SESSION['user']['tariff'] == $item['id']) echo 'selected' ?>" data-id="<?=$item['id']?>" type="button" >
                            <?php echo ($_SESSION['user']['tariff'] == $item['id']) ? 'Выбран сейчас' : 'Выбрать'?>
                        </button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</div>