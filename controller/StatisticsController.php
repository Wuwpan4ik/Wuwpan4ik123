<?php
    class StatisticsController extends ACoreCreator {

        function GetMonthsStatistics(){
            return $this->m->GetMonthValue();
        }

        function GetPrevMonthsStatistics(){
            return $this->m->GetPrevMonthValue();
        }

        function GetWeekStatistics(){
            return $this->m->GetWeekValue();
        }

        function GetPrevWeekStatistics(){
            return $this->m->GetPrevWeekValue();
        }

        function GetOneUserValue(){
            return $this->m->GetOneUserValue();
        }

        function GetCountFirstBuy() {
            return $this->m->GetCountFirstBuy();
        }


        public function GetAllStatistics() {
            $result = ["prev_week" => $this->GetPrevWeekStatistics(), "week" => $this->GetWeekStatistics(),
                "prev_month" => $this->GetPrevMonthsStatistics(), "month" => $this->GetMonthsStatistics(), "full_value" => $this->m->GetFullValue(),
                "one_user" => $this->GetOneUserValue(), "count_first_buy" => $this->GetCountFirstBuy()];
            echo json_encode($result);
        }

        public function GetWeekDays()
        {
            $result = $this->m->GetWeekDays();
            echo json_encode($result);
        }

        function get_content()
        {
            // TODO: Implement get_content() method.
        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }