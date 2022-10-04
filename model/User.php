<?php
    class User {
        public $db;

        public function __construct() {
            require_once 'connect.php';
            $this->db = $db;
        }

        public function getAllUsers() {
            $result = $this->db->query("SELECT * FROM user");
            return $result;
        }

        public function getAllProjects() {
            $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            return $result;
        }

        public static function getContentProject($id, $db) {
            $result = $db->query("SELECT * FROM course_content WHERE course_id = " . $id);
            return $result;
        }

        public function getContentProjectEdit() {
            $result = $this->db->query("SELECT * FROM course WHERE id = ".$_GET['id']);
            $videos = $this->db->query("SELECT * FROM course_content WHERE course_id = ".$result[0]['id']);
            return [$result, $videos];
        }
    }
?>