<?php
    class Tariff extends ConnectDatabase {

        use CheckDirSize;

        public function Get()
        {
            return $this->db->query("SELECT users_tariff.tariff_id, tariffs.funnel_count, tariffs.course_count, tariffs.file_size, tariffs.children_count FROM `users_tariff` INNER JOIN `tariffs` ON tariffs.id = users_tariff.tariff_id WHERE users_tariff.user_id = {$_SESSION['user']['id']}");
        }

        public function GetUserTariff()
        {
            return $this->db->query("SELECT * FROM `users_tariff` WHERE `user_id` = {$_SESSION['user']['id']}")[0];
        }

        public function getTariffs () {
            $result = $this->db->query("SELECT * FROM tariffs");
            return $result;
        }

        public function CheckInfoTariff()
        {
            $file_size = $this->dir_size('./uploads/users/' . $_SESSION['user']['id']) / 1024 / 1024;
            $funnel_count = $this->db->query("SELECT * FROM `funnel` WHERE `author_id` = {$_SESSION['user']['id']}");
            $course_count = $this->db->query("SELECT * FROM `course` WHERE `author_id` = {$_SESSION['user']['id']}");
            $children_count = $this->db->query("SELECT * FROM `clients` WHERE `creator_id` = {$_SESSION['user']['id']}");

            return ['funnel_count' => $funnel_count, 'course_count' => $course_count, 'children_count' => $children_count, 'file_size' => $file_size];
        }

        public function GetTariff($user_id)
        {
            $result = $this->db->query("SELECT users_tariff.user_id, users_tariff.tariff_id, users_tariff.date, tariffs.file_size, tariffs.children_count as 'children', tariffs.name FROM `users_tariff` INNER JOIN `tariffs` ON tariffs.id = users_tariff.tariff_id WHERE users_tariff.user_id = {$user_id}");
            if (count($result) == 1) {
                return $result;
            }
            unset($_SESSION['user']['tariff']);
            return false;
        }

        public function BuyTariff($user_id, $tariff_id)
        {
            $duration = $this->db->query("SELECT duration FROM `tariffs` WHERE `id` = {$tariff_id}")[0]['duration'];

            if (in_array($duration, ['MONTH', 'WEEK', 'YEAR'])) {
                $date_end =  date("Y-m-d", strtotime("+1 $duration", mktime(0, 0, 0, date('m'), date('d'), date('Y'))));
                if (!$this->GetTariff($user_id)) {
                    $this->db->execute("INSERT INTO `users_tariff` (`user_id`, `tariff_id`, `date`) VALUES ('$user_id', '$tariff_id', '$date_end')");
                } else {
                    $this->db->execute("UPDATE `users_tariff` SET `tariff_id` = '$tariff_id', `date` = '$date_end' WHERE `user_id` = '$user_id'");
                }
            } else {
                $request = 'Невалидное значение даты';
                return false;
            }

            return true;
        }
    }