<?php
    class Tariff extends ConnectDatabase {

        public function GetUserTariff()
        {
            return $this->db->query("SELECT * FROM `users_tariff` WHERE `user_id` = {$_SESSION['user']['id']}")[0];
        }

        public function Get()
        {
            return $this->db->query("SELECT users_tariff.tariff_id, tariffs.funnel_count, tariffs.course_count, tariffs.file_size, tariffs.children_count FROM `users_tariff` INNER JOIN `tariffs` ON tariffs.id = users_tariff.tariff_id WHERE users_tariff.user_id = {$_SESSION['user']['id']}");
        }
    }