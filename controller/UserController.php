<?php

class UserController extends ACore
{

    function getCourseSite() {
        $author_id = $_GET['author_id'];
        $course_page = $this->m->getContentForUserCoursePage($author_id);
        $div = '';
        foreach ($course_page as $item) {
            $name = $item['name'];
            $div .= '
            <div class="popup__allLessons-item availableСourses">
                <div class="popup__allLessons-item__header">
                    <input type="text" hidden="hidden" id="id" value="'. $item['id'] .'">
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
                                    '. $item['count'] .' урока
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

    function getDisableCourseSite() {
        $author_id = $_GET['author_id'];
        $course_page = $this->m->getDisableContentForUserCoursePage($author_id);
        $div = '';
        foreach ($course_page as $item) {
            $name = $item['name'];
            $div .= '
            <div class="popup__allLessons-item otherCourses">
                <div class="popup__allLessons-item__header">
                    <input type="text" hidden="hidden" id="id" value="'. $item['id'] .'">
                    <div class="popup-item">
                        <div class="popup__allLessons-item-video__img">
                            <img src="../img/smallPlayer/Group1426.png" alt="">
                            <div class="popup__allLessons-item-video-play">
                                <img src="../img/smallPlayer/play.png" alt="">
                            </div>
                        </div>
                        <div class="popup__allLessons-item-info">
                            <div class="popup__allLessons-item-info-header">
                                <div class=" aboutTheAuthor popup__allLessons-item-info-header-number notAvailable-number">
                                    Курс
                                </div>
                                <div class="aboutTheAuthor-name">
                                    '. $item['count'] .' урока
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

    function getList() {
        $course_id = $_GET['course_id'];
        $course_page = $this->m->getContentForCourseListPage($course_id);
        $div = '';
        $counter = 1;
        $disable = $_GET['disable'];
        $class = '';
        $grey_back = '';
        if ($disable) {
            $class = 'choice-video';
            $grey_back = 'style ="background: #444444;"';
        }
        foreach ($course_page as $item) {
            $getID3 = new getID3;
            $file = $getID3->analyze($item['video']);
            $duration = $file['playtime_string'];
            $div .= '<div class="popup__allLessons-item '. $class .'">
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
                                            <div class=" aboutTheAuthor popup__allLessons-item-info-header-number available-number"' . $grey_back . '>
                                                Урок '. $counter .'
                                            </div>
                                            <div class="aboutTheAuthor-name">
                                                '. $duration .'
                                            </div>
                                        </div>
                                        <div class="popup__allLessons-item-info-title">
                                            '. $item['name'] .'
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            $counter++;
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