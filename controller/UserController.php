<?php

class UserController extends ACoreCreator
{
    private function GetClient($creator_id, $course_id) {
        return $this->m->db->query("SELECT * FROM `clients` WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
    }

    private function GetPriceOfCourse($course_id) {
        return $this->m->db->query("SELECT * FROM `course` WHERE id = '$course_id'");
    }

    private function GetPriceOfVideo($video_id) {
        return $this->m->db->query("SELECT * FROM `course_content` WHERE id = '$video_id'");
    }

    private function check_purchase($purchase) {
        foreach ($purchase as $item) {
//            if ()
        }
    }

    public function InsertToTable($creator_id, $course_id, $buy_progress, $course_price) {
        $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        $this->m->db->execute("INSERT INTO `clients` (`first_name`, `email`, `tel`, `creator_id`, `course_id`, `give_money`, `buy_progress`, `achivment_date`) VALUES ('$this->name', '$this->email', '$this->phone', '$creator_id', '$course_id', '$course_price', '$buy_progress', '$current_date')");
        return true;
    }

    public function RequestValidate()
    {
        $this->email = $_POST['email'];
        if (isset($_POST['name'])) {
            $this->name = $_POST['name'];
//                if (!preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$this->name)) {
//                    return false;
//                }
        }
//        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
//            return false;
//        }

        if (isset($_POST['phone'])) {
            $this->phone = $_POST['phone'];
        } else {
            $this->phone = null;
        }

        return True;
    }

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
        $purchase = $this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id']);
        $purchase_info = json_decode($purchase[0]['purchase'], true);
        $div = '';
        $counter = 1;
        $disable = $_GET['disable'];
        if ($disable) {
            $price = $this->m->getContentPriceForCourseListPage($course_id);
        }
        foreach ($course_page as $item) {
            $class = '';
            $grey_back = '';
            $getID3 = new getID3;
            $file = $getID3->analyze($item['video']);
            $duration = $file['playtime_string'];
            if ($disable) {
                if (!in_array($item['id'], $purchase_info['video_id']) == 1) {
                    $class = 'choice-video';
                    $grey_back = 'style ="background: #444444;"';
                }
            }
            $div .= '<div data-id="'. $item['id'] .'" class="popup__allLessons-item '. $class .'">
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

    function getBuyCourse() {
        $course_id = $_GET['course_id'];
        $course = $this->m->db->query("SELECT course.name, course.description, course.author_id, course.price, count(course_content.id) as 'count' FROM course_content INNER JOIN course ON course_content.course_id = course.id WHERE course.id = $course_id");
        echo json_encode($course);
    }

    function getBuyVideo() {
        $video_id = $_GET['video_id'];
        $content = $this->m->db->query("SELECT course_content.id, course_content.name, course_content.description, course_content.video, course_content.price, course_content.query_id, user.id AS 'author_id' FROM course_content INNER JOIN course ON course_content.course_id = course.id INNER JOIN user ON course.author_id = user.id WHERE course_content.id = '$video_id'")[0];
        $getID3 = new getID3;
        $file = $getID3->analyze($content['video']);
        $duration = $file['playtime_string'];
        array_push($content, $duration);
        echo json_encode($content);
    }

    public function BuyCourse() {
        if (!$this->RequestValidate()) return false;

        $buy_progress = include './settings/buy_progress.php';
        $creator_id = $_POST['creator_id'];
        $course_id = $_POST['course_id'];
        $comment = 'Купил курс';
        $client = $this->GetClient($creator_id, $course_id);
        $give_money = $client[0]['give_money'] + $this->GetPriceOfCourse($course_id)[0]['price'];

        if (count($client) == 1){
            if ($client[0]['buy_progress'] < $buy_progress[$comment]) {
                $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money' WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
            }
        } else {
            $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);
        }
        $purchase = $this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id']);
        if (count($purchase) == 1) {
            $purchase_info = json_decode($purchase[0]['purchase'], true);
            if (!in_array($course_id, $purchase_info['course_id'])) {
                array_push($purchase_info['course_id'], $course_id);
                $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_info) . "' WHERE user_id = " . $_SESSION['user']['id']);
            }
        } else {
            $user_id = $_SESSION['user']['id'];
            $purchase_text = '{"course_id":["'.$course_id.'"]}';
            $this->m->db->execute("INSERT INTO `purchase` (`user_id`, `purchase`) VALUES ($user_id, '$purchase_text')");
        }
        return true;
    }

    public function BuyVideo() {
        if (!$this->RequestValidate()) return false;

        $buy_progress = include './settings/buy_progress.php';
        $creator_id = $_POST['creator_id'];
        $course_id = $_POST['course_id'];
        $comment = 'Купил видео';
        $client = $this->GetClient($creator_id, $course_id);
        $give_money = $client[0]['give_money'] + $this->GetPriceOfVideo($course_id)[0]['price'];

        if (count($client) == 1){
            if ($client[0]['buy_progress'] <= $buy_progress[$comment]) {
                $this->m->db->execute("UPDATE `clients` SET `buy_progress` = '$buy_progress[$comment]', `give_money` = '$give_money' WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
            }
        } else {
            $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);
        }
        $purchase = $this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id']);
        if (count($purchase) == 1) {
            $purchase_info = json_decode($purchase[0]['purchase'], true);
            if (!in_array($course_id, $purchase_info['video_id'])) {
                array_push($purchase_info['video_id'], $course_id);
                $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_info) . "' WHERE user_id = " . $_SESSION['user']['id']);
            }
        } else {
            $user_id = $_SESSION['user']['id'];
            $purchase_text = '{"course_id":[""], "video_id":["'. $course_id .'"]}';
            $this->m->db->execute("INSERT INTO `purchase` (`user_id`, `purchase`) VALUES ($user_id, '$purchase_text')");
        }
//      Проверка на покупку всех видео и добавление курса в купленные
        $purchase_video = json_decode($this->m->db->query("SELECT purchase FROM purchase WHERE user_id = ". $_SESSION['user']['id'])[0]['purchase'], true);
        $id = $this->m->db->query("SELECT course_content.course_id FROM course_content WHERE id = '$course_id'")[0]['course_id'];
        $course_list = explode(',', $this->m->db->query("SELECT GROUP_CONCAT(`id`) FROM `course_content` WHERE course_id = '$id'")[0]['GROUP_CONCAT(`id`)']);
        foreach ($course_list as $item) {
            if (!in_array($item, $purchase_video['video_id'])) {
                return true;
            }
        }
        foreach ($purchase_video['video_id'] as $key=>$item) {
            if (in_array($item, $course_list)) unset($purchase_video['video_id'][$key]);
        }
        array_push($purchase_video['course_id'], $id);
        $this->m->db->execute("UPDATE `purchase` SET purchase = '" . json_encode($purchase_video) . "' WHERE user_id = " . $_SESSION['user']['id']);
        return true;
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