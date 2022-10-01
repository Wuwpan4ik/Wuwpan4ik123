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
    }
?>