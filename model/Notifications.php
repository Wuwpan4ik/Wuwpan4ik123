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

        public function addNotifications($title, $message, $image, $class, $user_id = null) {
            if (is_null($user_id)) $user_id = $_SESSION['user']['id'];
            $date = date("Y-m-d");
            $time = date("H:i:s");
            return $this->db->execute("INSERT INTO `notifications` (`user_id`, `title`, `body`, `class`, `image`, `date`, `time`, `is_checked`) VALUES ('$user_id', '$title', '$message', '$class', '$image', '$date', '$time', 0)");
        }
    }