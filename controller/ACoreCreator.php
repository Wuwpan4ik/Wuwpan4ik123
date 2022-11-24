<?php
    abstract class ACoreCreator {

        protected $m;

        protected $url_dir;

        public function __construct() {
            date_default_timezone_set('Europe/Moscow');
            $this->m = new User();
            $this->url_dir = "./uploads/users/" . $_SESSION['user']['id'] . '/';
        }

        public function obr() {
            if (isset($_SESSION['user']['is_creator']) && $_SESSION['user']['is_creator'] == 0) {
                header("Location: /UserMain");
            } else if (!isset($_SESSION['user']['id'])) {
                header("Location: /reg");
            }
        }

        public function addNotifications($class, $message, $image, $user_id = null) {
            if (is_null($user_id)) $user_id = $_SESSION['user']['id'];
            $date = date("Y-m-d");
            $time = date("H:i:s");
            return $this->m->db->execute("INSERT INTO `notifications` (`user_id`, `class`, `body`, `image`, `date`, `time`, `is_checked`) VALUES ('$user_id', '$class', '$message', '$image', '$date', '$time', 0)");
        }

        protected function dir_size($path) {
            $path = rtrim($path, '/');
            $size = 0;
            $dir = opendir($path);
            if (!$dir) {
                return 0;
            }

            while (false !== ($file = readdir($dir))) {
                if ($file == '.' || $file == '..') {
                    continue;
                } elseif (is_dir($path . $file)) {
                    $size += dir_size($path . DIRECTORY_SEPARATOR . $file);
                } else {
                    $size += filesize($path . DIRECTORY_SEPARATOR . $file);
                }
            }
            closedir($dir);
            return $size;
        }
    }