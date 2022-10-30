<?php
class PopupController extends ACore {

    function get_content() {}

    function get_popup()
    {
        $category = $_GET['category'];
        switch ($category) {
            case 'list':
            {
                $content = $this->m->getPopupForPreloader($_GET['id']);
                $div = "<div class=\"overlay-allLessons overlay overlay-video\">
                        <div class=\"popup__allLessons popup popup-button popup-video\">
                            <div class=\"popup__allLessons-body\">
                                <div class=\"popup__allLessons-title popup-title\">Все уроки курса:</div>
                                <div class=\"popup__allLessons-text popup-text\">Курс состоит из " . count($content['course_content']) . " уроков</div>
                                <div class=\"popup__allLessons-body\">";
                                    $count = 1;
                                    foreach ($content['course_content'] as $item) {
                                        $div = $div . "<div class=\"popup__allLessons-item popup-item\">
                                            <div class=\"popup__allLessons-item-video\">
                                                <div class=\"popup__allLessons-item-video-play\">
                                                    <img src=\"../img/smallPlayer/play.png\" alt=\"\">
                                                </div>
                                                <img src=\"../img/smallPlayer/Group1426.png\" alt=\"\">
                                            </div>
                                            <div class=\"popup__allLessons-item-info\">
                                                <div class=\"popup__allLessons-item-info-header\">
                                                    <div class=\"popup__allLessons-item-info-header-number\">0" .
                                                        $count . "
                                                    </div>
                                                </div>
                                                <div class=\"popup__allLessons-item-info-title\"> "
                                                    . $item['name'] . "
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    $div = $div . $count . "
                                </div>
                            </div>
                            <div class=\"popup__allLessons-form\">
                                <div class=\"popup__allLessons-form-buy button-open\">
                                    <button class=\"button button-buy\">Купить весь курс за " .$content['course_sum'] . " руб.</button>
                                </div>
                                <div class=\"popup__allLessons-form-notBuy\">
                                    <button class=\"button button-notBuy\">Пока не хочу покупать</button>
                                </div>
                            </div>
                        </div>
                    </div>";
                echo $div;
                return True;
            }
        }
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}