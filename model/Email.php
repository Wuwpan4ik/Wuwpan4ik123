<?php
    class Email extends ConnectDatabase {

        public function GetEmailAccount() {
            return $this->db->query("SELECT * FROM `email_account` LIMIT 1")[0];
        }
    }