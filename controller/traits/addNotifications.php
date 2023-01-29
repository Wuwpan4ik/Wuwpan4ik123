<?php
    trait addNotifications {
        public function addNotifications($title, $message, $image, $class, $user_id = null) {
            if (is_null($user_id)) $user_id = $_SESSION['user']['id'];
            $date = date("Y-m-d");
            $time = date("H:i:s");
            return $this->m->db->execute("INSERT INTO `notifications` (`user_id`, `title`, `body`, `class`, `image`, `date`, `time`, `is_checked`) VALUES ('$user_id', '$title', '$message', '$class', '$image', '$date', '$time', 0)");
        }
    }