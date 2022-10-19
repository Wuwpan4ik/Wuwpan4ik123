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
        
        public function getClientList () {
		$current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
		$last_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
			
        $res = $this->db->query("SELECT * FROM clients WHERE creator_id = " . $_SESSION['user']['id'] . " AND achivment_date BETWEEN CAST('$last_date' AS DATE) AND CAST('$current_date' AS DATE)");
		$query = $this->db->query("SELECT * FROM user WHERE id IN (SELECT client_id FROM clients WHERE creator_id = " . $_SESSION['user']['id'].")");
		return $result = [$res, $query];
		}

        public function getUserProjects() {
            $result = $this->db->query("SELECT * FROM course WHERE author_id = " . $_SESSION['user']['id'] . " GROUP BY id");
            return $result;
        }

        public function getContentForProjectEdit() {
            $result = $this->db->query("SELECT * FROM course WHERE id = ".$_GET['id']);
            $videos = $this->db->query("SELECT * FROM course_content WHERE course_id = ".$result[0]['id']);
            return [$result, $videos];
        }

        public function getContentForProjectPage() {
            $result = $this->getUserProjects();
            $videos = $this->db->query("SELECT * FROM course_content");
            return [$result, $videos];
        }
    }
?>
