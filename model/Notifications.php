<?php
    class Notifications extends ConnectDatabase {

        public function getCheckedNotifications($user_id) {
            $result = $this->db->query("SELECT * FROM notifications WHERE `user_id` = '$user_id' AND `is_checked` = 0");
            return $result;
        }

        public function getNotifications($user_id) {
            $result = $this->db->query("SELECT * FROM notifications WHERE `user_id` = '$user_id' ORDER BY id desc LIMIT 10");
            return $result;
        }

        public function checkNotifications()
        {
            $this->db->execute("UPDATE `notifications` SET `is_checked` = '1' WHERE user_id = ". $_SESSION['user']['id']);
        }
    }