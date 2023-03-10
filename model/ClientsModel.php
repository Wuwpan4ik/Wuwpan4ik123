<?php

    class ClientsModel extends ConnectDatabase {
        public function GetClientByIdAndEmail($course_id, $email)
        {
            return $this->db->query("SELECT * FROM `clients` WHERE `course_id` = '$course_id' AND `email` = '$email'");
        }

    }