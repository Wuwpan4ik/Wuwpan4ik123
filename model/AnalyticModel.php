<?php
    class AnalyticModel extends ConnectDatabase {
        protected $name = "";

        public function GetClientsForMain($get)
        {
            return $this->db->query("SELECT clients.email, clients.first_name, clients.give_money, clients.tel, course.id as 'course_id', course.name FROM clients, course WHERE course.id = clients.course_id AND `creator_id` = ". $_SESSION['user']['id'] ." ORDER BY $get");
        }

        public function GetClientsForAnalytics($get)
        {
            return $this->db->query("SELECT clients.id, course.name as course_name, course.id as course_id, clients.comment, clients.achivment_date, clients.give_money, first_name, email, tel FROM clients JOIN course ON clients.course_id = course.id WHERE creator_id = " . $_SESSION['user']['id']." ORDER BY " . $get);
        }

        public function GetOrdersForAnalytics($get)
        {
            return $this->db->query("SELECT course.name as course_name, course.id as course_id, orders.achivment_date, orders.money, user.first_name, user.email, user.telephone, orders.id FROM orders JOIN course ON orders.course_id = course.id JOIN user ON orders.user_id = user.id WHERE creator_id = " . $_SESSION['user']['id']." ORDER BY " . $get);
        }
    }