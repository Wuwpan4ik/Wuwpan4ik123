<?php
    if (!class_exists('PHPMailer\PHPMailer\Exception'))
    {
        require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require '/vendor/phpmailer/phpmailer/src/SMTP.php';
        require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    }

    class UserController extends ACoreCreator
    {
        private $password;
        private $name;
        private $phone;

        private function GetClient($creator_id, $course_id) {
            return $this->m->db->query("SELECT * FROM `clients` WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$this->email'");
        }

        private function GetPriceOfCourse($course_id) {
            return $this->m->db->query("SELECT * FROM `course` WHERE id = '$course_id'");
        }

        private function GetPriceOfVideo($video_id) {
            return $this->m->db->query("SELECT * FROM `course_content` WHERE id = '$video_id'");
        }

        public function InsertToTable($creator_id, $course_id, $buy_progress, $course_price) {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $this->m->db->execute("INSERT INTO `clients` (`first_name`, `email`, `tel`, `creator_id`, `course_id`, `give_money`, `buy_progress`, `achivment_date`) VALUES ('$this->name', '$this->email', '$this->phone', '$creator_id', '$course_id', '$course_price', '$buy_progress', '$current_date')");
            return true;
        }

        private function GenerateRandomPassword ($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
            $str = '';
            $max = strlen($keyspace) - 1;
            if ($max < 1) {
                throw new Exception('$keyspace must be at least two characters long');
            }
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[rand(0, $max)];
            }
            return $str;
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
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

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
                            </div>
                            <div class="popup__allLessons-item-info">
                                <div class="popup__allLessons-item-info-header">
                                    <div class=" aboutTheAuthor popup__allLessons-item-info-header-number Notavailable-number">
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
            foreach ($course_page as $item) {
                $class = '';
                $number_color = 'available-number';
                $url_start = "<a style='position:relative;' href='/UserPlayer/". $item['id'] . "'>";
                $url_end = "</a>";
                $image_available = '<img style="width: 100%; height: 100%;" src="'. $item['thubnails'] .'" alt="">';
                $getID3 = new getID3;
                $file = $getID3->analyze($item['video']);
                $duration = $file['playtime_string'];
                if (!in_array($item['id'], $purchase_info['video_id']) == 1) {
                    $class = 'choice-video';
                    $number_color = 'Notavailable-number';
                    $url_start = "";
                    $url_end = "";
                    $image_available = '<img style="width: 100%; height: 100%;" src="'. $item['thubnails'] .'" alt="">';
                }
                $div .='<div class="popup__allLessons-item">
                                <div class="popup__allLessons-item__header">
                            <div class="Course-item popup-item">
                            ' . $url_start . '
                                <div class="popup__allLessons-item-video__img '. $class .'" style="width: 160px; height: 100px;">
                                    <div data-id="'. $item['id'] .'" class="popup__allLessons-item item__list-id"></div>
                                        '. $image_available .'
                                </div>
                                ' . $url_end . '
                                <div class="popup__allLessons-item-info">
                                    <div class="popup__allLessons-item-info-header">
                                        <div class=" aboutTheAuthor '. $number_color .'">
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
                                <button class="accordion-button" id="accordion-button-1" aria-expanded="false">
                                <span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <div class="accordion-content">
                                            <p>'. $item['description'] .'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>';
                $counter++;
            }
            echo $div;
        }

        function GetListForSmallPlayer() {
            $course_content = $this->m->db->query("SELECT course_content.name,
                                                course_content.description,
                                                course_content.video,
                                                course_content.price,
                                                course_content.thubnails
                                                FROM `funnel` AS funnel
                                                INNER JOIN `course_content` AS course_content ON course_content.course_id = funnel.course_id AND funnel.id = '$id'");
            $count = 1;
            foreach ($course_content as $item) {
                $div = '<div class="popup__allLessons-item popup-item">
                    <div class="popup__allLessons-item-video">
                        <div class="popup__allLessons-item-video__img">
                            <img src="/' . $item['thubnails'] . '" alt="">
                            <div class="popup__allLessons-item-video-play">
                                <img src="../img/smallPlayer/play.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="popup__allLessons-item-info">
                        <div class="popup__allLessons-item-info-header">
                            <div class="popup__allLessons-item-info-header-number">
                                ' .$count . '
                            </div>
                        </div>
                        <div class="popup__allLessons-item-info-title">
                            ' .$item['name'] . '
                        </div>
                    </div>
                </div>';
                $count += 1;
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
            $content = $this->m->db->query("SELECT course_content.id, course_content.thubnails, course_content.name, course_content.description, course_content.video, course_content.price, course_content.query_id, user.id AS 'author_id' FROM course_content INNER JOIN course ON course_content.course_id = course.id INNER JOIN user ON course.author_id = user.id WHERE course_content.id = '$video_id'")[0];
            $getID3 = new getID3;
            $file = $getID3->analyze($content['video']);
            $duration = $file['playtime_string'];
            array_push($content, $duration);
            echo json_encode($content);
        }

        public function GetCourseList() {
            echo json_encode($this->m->db->query("SELECT * from course WHERE `author_id` = " . $_SESSION['user']['id']));
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