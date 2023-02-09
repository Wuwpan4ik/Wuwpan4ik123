<?php
    class Statistic extends ConnectDatabase {

        protected function GetMoneyForWeekInterval($prev = false) {
            if ($prev) {
                $prev_week = "- INTERVAL 1 WEEK";
            } else {
                $prev_week = '';
            }
            return $this->db->query("select sum(give_money) as money, to_char(achivment_date, 'DAY') as day
                                    from clients WHERE YEAR(`achivment_date`) = YEAR(NOW()) AND WEEK(`achivment_date`, 1) = WEEK(NOW() $prev_week, 1) and `creator_id` = ". $_SESSION['user']['id'] ."
                                    group by day order by mod(to_char(achivment_date, 'DAY') + 5, 7)");
        }

        protected function GetMoneyForMonthInterval($prev = false) {
            if ($prev) {
                $prev_month = "- INTERVAL 1 MONTH";
            } else {
                $prev_week = '';
            }
            $days_in_month = date('t');
            return $this->db->query("select sum(give_money) as money, to_char(achivment_date, 'MONTH') as day
                                    from clients WHERE YEAR(`achivment_date`) = YEAR(NOW()) AND MONTH(`achivment_date`) = MONTH(NOW() $prev_month) and `creator_id` = ". $_SESSION['user']['id'] ."
                                    group by day order by mod(to_char(achivment_date, 'MONTH') + 5, $days_in_month)");
        }

        public function GetMonthValue()
        {
            $sum = 0;
            $result = $this->GetMoneyForMonthInterval();
            foreach ($result as $item) {
                $sum += $item['money'];
            }
            return $sum;
        }

        public function GetPrevMonthValue()
        {
            $sum = 0;
            $result = $this->GetMoneyForMonthInterval(true);
            foreach ($result as $item) {
                $sum += $item['money'];
            }
            return $sum;
        }

        public function GetWeekValue()
        {
            $sum = 0;
            $result = $this->GetMoneyForWeekInterval();
            foreach ($result as $item) {
                $sum += $item['money'];
            }
            return $sum;
        }

        public function GetPrevWeekValue()
        {
            $sum = 0;
            $result = $this->GetMoneyForWeekInterval(true);
            foreach ($result as $item) {
                $sum += $item['money'];
            }
            return $sum;
        }

        public function GetFullValue()
        {
            $sum = 0;
            $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id']);
            foreach ($result as $item) {
                $sum += $item['give_money'];
            }
            return $sum;
        }

        public function GetOneUserValue()
        {
            $sum = 0;
            $result = $this->db->query("SELECT give_money from clients WHERE `creator_id` = " . $_SESSION['user']['id']);
            foreach ($result as $item) {
                $sum += $item['give_money'];
            }
            if ($result) {
                return round($sum / count($result));
            }
            return 0;
        }

        public function GetCountFirstBuy()
        {
            $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
            $result = count($this->db->query("SELECT * from clients WHERE `first_buy` = 1 AND `creator_id` = " . $_SESSION['user']['id'] . " AND `achivment_date` BETWEEN '$current_date' -  interval 1 MONTH AND '$current_date'"));
            return $result;
        }

        public function GetWeekDays()
        {
            $result = $this->GetMoneyForWeekInterval();
            return $result;
        }

        public function GetCountApplication() {
            return count($this->db->query("SELECT * FROM `clients` WHERE `creator_id` = {$_SESSION['user']['id']} AND `buy_progress` = 0"));
        }

        public function GetCountClients() {
            return count($this->db->query("SELECT * FROM `clients` WHERE `creator_id` = {$_SESSION['user']['id']}"));
        }

        public function GetCountOrder() {
            return count($this->db->query("SELECT * FROM `orders` WHERE `creator_id` = {$_SESSION['user']['id']}"));
        }

        public function GetCountViewFunnel()
        {
            return (int) $this->db->query("SELECT SUM(`views`) as 'views' FROM `funnel` WHERE `author_id` = {$_SESSION['user']['id']}")[0]['views'];
        }
    }