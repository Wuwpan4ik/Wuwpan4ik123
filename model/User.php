<?php
    class User {
        public $db;

        public function __construct() {
            require_once 'connect.php';
            $this->db = $db;
        }

        public function getCurrentUser() {
            $result = $this->db->query("SELECT * FROM user WHERE id = " . $_SESSION['user']['id']);
            return $result;
        }

        public function getAllUsers() {
            $result = $this->db->query("SELECT * FROM user");
            return $result;
        }
        
        public function getClientList () {
		$current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
		$last_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
		
        $result = $this->db->query("SELECT clients.id, clients.comment, clients.achivment_date, clients.source, clients.give_money, user.first_name as first_name, user.second_name as second_name, user.email as email, user.telephone as telephone FROM clients JOIN user ON clients.client_id = user.id WHERE creator_id = " . $_SESSION['user']['id']." AND achivment_date BETWEEN CAST('$last_date' AS DATE) AND CAST('$current_date' AS DATE)");
		return $result;
		}

        public function getUserProjects() {
            $result = $this->db->query("SELECT * FROM funnel WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            return $result;
        }
        
        public function getTariffs () {
            $result = $this->db->query("SELECT * FROM tariffs");
            return $result;
		}

        public function getContentForFunnelEdit() {
            $result = $this->db->query("SELECT * FROM funnel WHERE id = ".$_GET['id']);
            $videos = $this->db->query("SELECT * FROM funnel_content WHERE funnel_id = ".$result[0]['id']);
            return [$result, $videos];
        }

        public function getContentForCourseEdit() {
            $result = $this->db->query("SELECT * FROM course WHERE id = ".$_GET['id']);
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

        public function getVideosForPlayer()
        {
            $id = $_GET['id'];
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

        public function getPopupJson($id) {
            $json = $this->db->query("SELECT * FROM `funnel_content` WHERE `id` = '$id'");
            return $json;
        }
    }
?>
