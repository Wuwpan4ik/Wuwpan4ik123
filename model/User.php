<?php
    class User {
        public $db;

        public function __construct() {
            require_once 'connect.php';
            date_default_timezone_set('Europe/Moscow');
            $this->db = $db;
        }

        public function getCurrentUser() {
            $result = $this->db->query("SELECT * FROM user WHERE id = " . $_SESSION['user']['id']);
            return $result;
        }

        public function getUserByEmail($email) {
            $result = $this->db->query("SELECT * FROM user WHERE email = '$email'");
            return $result;
        }

        public function getContactsByUser()
        {
            return $this->db->query("SELECT user.id, user.telephone, user.email, contact.instagram, contact.whatsapp, contact.telegram, contact.facebook, contact.youtube, contact.twitter, contact.skype FROM user LEFT JOIN user_contacts as contact ON contact.user_id = user.id WHERE user.id = " . $_SESSION['item_id']);
        }

        public function UserHaveAContacts()
        {
            return $this->db->query("SELECT id FROM  user_contacts WHERE id = " . $_SESSION['item_id']);
        }

        public function getNotifications($user_id) {
            $result = $this->db->query("SELECT * FROM notifications WHERE `user_id` = '$user_id' AND `is_checked` = 0");
            return $result;
        }

        public function getCourseVideo($id) {
            $result = $this->db->query("SELECT  
                                                content.name AS 'content_name',
                                                content.description AS 'content_description',
                                                content.video,
                                                course.id,
                                                course.name,
                                                content.thubnails,
                                                content.query_id,
                                                user_info.id as 'user_id',
                                                user_info.avatar,
                                                user_info.first_name
                                                FROM `course_content` AS content
                                                INNER JOIN `course` AS course ON content.course_id = course.id
                                                INNER JOIN `user` AS user_info ON course.author_id = user_info.id WHERE content.id = '$id'");
            return $result;
        }

        public function getTariffs () {
            $result = $this->db->query("SELECT * FROM tariffs");
            return $result;
		}

        public function getContentForFunnelEdit() {
            $result = $this->db->query("SELECT * FROM funnel WHERE id = ".$_SESSION['item_id']);
            $videos = $this->db->query("SELECT * FROM funnel_content WHERE funnel_id = ".$result[0]['id']);
            return [$result, $videos];
        }

        public function getContentForUserAuthorPage()
        {
            $purchases = $this->db->query("SELECT `purchase` FROM `purchase` WHERE user_id = " . $_SESSION['user']['id'])[0]['purchase'];
            $course_query = "SELECT user.id, course.name, user.avatar, user.school_name, course.description, user.first_name, user.second_name, count(course.id) as 'count', course.author_id FROM course AS course INNER JOIN user ON user.id = course.author_id WHERE";
            $purchases_array = json_decode($purchases, true)['course_id'];
            foreach ($purchases_array as $course_id) {
                $course_query .= " course.id = $course_id ";
                if (count($purchases_array) != 1) {
                    $course_query .= " OR ";
                } else {
                    $course_query .= " GROUP BY user.id ";
                    break;
                }
                array_shift($purchases_array);
            }
            $courses = $this->db->query($course_query);
            return $courses;
        }

        public function getContentForUserCoursePage($author_id)
        {
            $purchases = $this->db->query("SELECT `purchase` FROM `purchase` WHERE user_id = " . $_SESSION['user']['id'])[0]['purchase'];
            $purchases_array = json_decode($purchases, true)['course_id'];
            $course_query = "SELECT course.id, course.name, course.description, course.author_id, count(course_content.id) as 'count' FROM course INNER JOIN course_content on course_content.course_id = course.id WHERE (";
            foreach ($purchases_array as $course_id) {
                $course_query .= " course.id = $course_id ";
                if (count($purchases_array) != 1) {
                    $course_query .= " OR ";
                } else {
                    $course_query .= ") GROUP BY course_id";
                }
                array_shift($purchases_array);
            }
            $courses = $this->db->query($course_query);
            return $courses;
        }

        public function getDisableContentForUserCoursePage($author_id)
        {
            $purchases = $this->db->query("SELECT `purchase` FROM `purchase` WHERE user_id = " . $_SESSION['user']['id'])[0]['purchase'];
            $purchases_array = json_decode($purchases, true)['course_id'];
            $course_query = "SELECT course.id, course.name, course.description, course.author_id, count(course_content.id) as 'count' FROM course INNER JOIN course_content on course_content.course_id = course.id WHERE ($author_id = course.author_id) AND NOT (";
            foreach ($purchases_array as $course_id) {
                $course_query .= " course.id = $course_id ";
                if (count($purchases_array) != 1) {
                    $course_query .= " OR ";
                } else {
                    $course_query .= ") GROUP BY course_id";
                }
                array_shift($purchases_array);
            }
            $courses = $this->db->query($course_query);
            return $courses;
        }

        public function getContentForCourseListPage($course_id){
            $course_query = "SELECT course_content.id, course_content.description, course_content.thubnails, course_content.name, course_content.description, course_content.video FROM course_content WHERE ($course_id = course_content.course_id)";
            $courses = $this->db->query($course_query);
            return $courses;
        }

        public function getContentPriceForCourseListPage($course_id) {
            $course_query = "SELECT price FROM course WHERE ($course_id = course.id)";
            $price = $this->db->query($course_query);
            return $price;
        }

        public function getContentForCourseEdit() {
            $result = $this->db->query("SELECT * FROM course WHERE id = ".$_SESSION['item_id']);
            $videos = $this->db->query("SELECT * FROM course_content WHERE course_id = ".$result[0]['id']);
            return [$result, $videos];
        }

        public function getContentForFunnelPage() {
            $result = $this->db->query("SELECT * FROM funnel WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            $videos = $this->db->query("SELECT * FROM funnel_content");
            return [$result, $videos];
        }

        public function getCourseUser() {
            $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            return $result;
        }

        public function getContentForCoursePage() {
            $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            $videos = $this->db->query("SELECT * FROM course_content");
            return [$result, $videos];
        }

        public function getUserMessengers() {
            $user_id = $_SESSION['user']['id'];
            $result = $this->db->query("SELECT * FROM chats WHERE `user_from` = '$user_id' OR `user_to` = '$user_id'");
            return $result;
        }

        public function getAuthorInfo() {
            $user_id = $_SESSION['item_id'];
            $result = $this->db->query("SELECT * FROM user WHERE `id` = '$user_id'");
            return $result;
        }

        public function GetMonthValue()
        {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $last_date = date("Y-m-d", mktime(0, 0, 0, date('m') - 1, date('d'), date('Y')));
            $sum = 0;
            $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id'] . " AND `achivment_date` BETWEEN '$last_date' -  interval 1 MONTH AND '$current_date'");
            foreach ($result as $item) {
                $sum += $item['give_money'];
            }
            return $sum;
        }

        public function GetPrevMonthValue()
        {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m') - 1, date('d'), date('Y')));
            $last_date = date("Y-m-d", mktime(0, 0, 0, date('m') - 2, date('d'), date('Y')));
            $sum = 0;
            $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id'] . " AND `achivment_date` BETWEEN '$last_date' -  interval 2 MONTH AND '$current_date' interval - 1 MONTH");
            foreach ($result as $item) {
                $sum += $item['give_money'];
            }
            return $sum;
        }

        public function GetWeekValue()
        {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $last_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $sum = 0;
            $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id'] . " AND `achivment_date` BETWEEN '$last_date' -  interval 1 WEEK AND '$current_date'");
            foreach ($result as $item) {
                $sum += $item['give_money'];
            }
            return $sum;
        }

        public function GetPrevWeekValue()
        {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $last_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $sum = 0;
            $result = $this->db->query("SELECT * from clients WHERE `creator_id` = " . $_SESSION['user']['id'] . " AND `achivment_date` BETWEEN '$last_date' -  interval 2 WEEK AND '$current_date' - interval 1 WEEK");
            foreach ($result as $item) {
                $sum += $item['give_money'];
            }
            return $sum;
        }

        public function GetFullValue()
        {
            $sum = 0;
            $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id']);
            foreach ($result as $item) {
                $sum += $item['give_money'];
            }
            return $sum;
        }

        public function GetOneUserValue()
        {
            $sum = 0;
            $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id']);
            foreach ($result as $item) {
                $sum += $item['give_money'];
            }
            return $sum / count($result);
        }

        public function GetCountFirstBuy()
        {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $last_date = date("Y-m-d", mktime(0, 0, 0, date('m') - 1, date('d'), date('Y')));
            $result = count($this->db->query("SELECT * from clients WHERE `first_buy` = 1 AND `creator_id` = " . $_SESSION['user']['id'] . " AND `achivment_date` BETWEEN '$last_date' -  interval 1 MONTH AND '$current_date'"));
            return $result;
        }

        public function GetWeekGraph()
        {
            $current_date_6 = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 6, date('Y')));
            $current_date_5 = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 5, date('Y')));
            $current_date_4 = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 4, date('Y')));
            $current_date_3 = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 3, date('Y')));
            $current_date_2 = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
            $current_date_1 = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $result = $this->db->query("select give_money, achivment_date from clients where `achivment_date` between (date_sub(now(),INTERVAL 1 WEEK) and now()) and `creator_id` = ". $_SESSION['user']['id'] ." ORDER BY achivment_date");
            $array = array_fill(0, 7, 0);
            foreach ($result as $item) {
                if ($item['achivment_date'] == $current_date) {
                    $array[0] += $item['give_money'];
                }
                elseif ($item['achivment_date'] == $current_date_1) {
                    $array[1] += $item['give_money'];
                }
                elseif ($item['achivment_date'] == $current_date_2) {
                    $array[2] += $item['give_money'];
                }
                elseif ($item['achivment_date'] == $current_date_3) {
                    $array[3] += $item['give_money'];
                }
                elseif ($item['achivment_date'] == $current_date_4) {
                    $array[4] += $item['give_money'];
                }
                elseif ($item['achivment_date'] == $current_date_5) {
                    $array[5] += $item['give_money'];
                }
                elseif ($item['achivment_date'] == $current_date_6) {
                    $array[6] += $item['give_money'];
                }
            }
            return array_reverse($array);
        }

        public function getVideosForPlayer()
        {
            $id = $_SESSION['item_id'];
            $funnel_content = $this->db->query("SELECT  
                                                course.id,
                                                course.name,
                                                course.description,
                                                course.price,
                                                content.name AS 'content_name',
                                                content.description AS 'content_description',
                                                content.popup,
                                                content.video,
                                                content.button_text,
                                                user_info.id as 'author_id',
                                                user_info.avatar,
                                                user_info.first_name
                                                FROM `course` AS course
                                                INNER JOIN `funnel` AS funnel ON course.id = funnel.course_id AND funnel.id = '$id'
                                                INNER JOIN `user` AS user_info ON funnel.author_id = user_info.id
                                                INNER JOIN `funnel_content` AS content ON content.funnel_id = funnel.id GROUP BY content.id");
            $course_content = $this->db->query("SELECT course_content.name,
                                                course_content.description,
                                                course_content.video,
                                                course_content.price 
                                                FROM `funnel` AS funnel
                                                INNER JOIN `course_content` AS course_content ON course_content.course_id = funnel.course_id AND funnel.id = '$id'");
            $course_sum = $this->db->query("SELECT
                                                course.price
                                                FROM `course` AS course
                                                INNER JOIN `funnel` AS funnel ON funnel.course_id = course.id AND funnel.id = '$id'");
            return ['funnel_content' => $funnel_content, 'course_content' => $course_content, 'course_sum' => $course_sum[0]['price']];

        }

        public function getPopupForPreloader($id)
        {
            $funnel_content = $this->db->query("SELECT  
                                                course.id,
                                                course.name,
                                                course.description,
                                                course.price,
                                                content.name AS 'content_name',
                                                content.description AS 'content_description',
                                                content.popup,
                                                content.video,
                                                content.button_text,
                                                user_info.id as 'author_id',
                                                user_info.avatar,
                                                user_info.first_name
                                                FROM `course` AS course
                                                INNER JOIN `funnel` AS funnel ON course.id = funnel.course_id AND funnel.id = '$id'
                                                INNER JOIN `user` AS user_info ON funnel.author_id = user_info.id
                                                INNER JOIN `funnel_content` AS content ON content.funnel_id = funnel.id GROUP BY content.id");
            $course_content = $this->db->query("SELECT course_content.name,
                                                course_content.description,
                                                course_content.video,
                                                course_content.price 
                                                FROM `funnel` AS funnel
                                                INNER JOIN `course_content` AS course_content ON course_content.course_id = funnel.course_id AND funnel.id = $id");
            $course_sum = $this->db->query("SELECT
                                                course.price
                                                FROM `course` AS course
                                                INNER JOIN `funnel` AS funnel ON funnel.course_id = course.id AND funnel.id = '$id'");
            return ['funnel_content' => $funnel_content, 'course_content' => $course_content, 'course_sum' => $course_sum[0]['price']];
        }

        public function getPopupJson($id) {
            $json = $this->db->query("SELECT * FROM `funnel_content` WHERE `id` = '$id'");
            return $json;
        }
    }
?>
