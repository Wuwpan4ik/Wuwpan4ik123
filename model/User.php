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

        public function getContentForCoursePage() {
            $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            $videos = $this->db->query("SELECT * FROM course_content");
            return [$result, $videos];
        }

        public function getVideosForPlayer()
        {
            $result = $this->db->query("SELECT * FROM funnel WHERE id = ". $_GET['id']);
            return $result;
        }
    }
?>
