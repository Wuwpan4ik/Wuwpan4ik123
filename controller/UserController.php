<?php

class UserController extends ACore
{

    function getAuthorSite() {
        $author_id = $_GET['author_id'];
        $course_page = $this->m->getContentForUserCoursePage($author_id);
        $div = '';
        foreach ($course_page as $item) {
            $name = $item['name'];
            $div .= '<div class="popup__allLessons-item availableСourses">
                <div class="popup__allLessons-item__header">
                    <div class="popup-item">
                        <div class="popup__allLessons-item-video__img">
                            <img src="../img/smallPlayer/Group1426.png" alt="">
                            <div class="popup__allLessons-item-video-play">
                                <img src="../img/smallPlayer/play.png" alt="">
                            </div>
                        </div>
                        <div class="popup__allLessons-item-info">
                            <div class="popup__allLessons-item-info-header">
                                <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number">
                                    Курс
                                </div>
                                <div class="aboutTheAuthor-name">
                                    22 урока
                                </div>
                            </div>
                            <div class="popup__allLessons-item-info-title">
                                ' . $name . '
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        echo $div;
    }

    function get_content()
    {
        // TODO: Implement get_content() method.
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}