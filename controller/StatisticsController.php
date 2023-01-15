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

        function GetCountApplication() {
            return $this->m->GetCountApplication();
        }

        function GetCountOrder() {
            return $this->m->GetCountOrder();
        }

        function GetCountViewFunnel() {
            return $this->m->GetCountViewFunnel();
        }

//        function GetCountViewCourse() {
//            return $this->m->GetCountViewCourse();
//        }

        public function GetAllStatistics() {
            $result = ["prev_week" => $this->GetPrevWeekStatistics(), "week" => $this->GetWeekStatistics(),
                "prev_month" => $this->GetPrevMonthsStatistics(), "month" => $this->GetMonthsStatistics(), "full_value" => $this->m->GetFullValue(),
                "one_user" => $this->GetOneUserValue(), "count_first_buy" => $this->GetCountFirstBuy(), "get_count_application" => $this->GetCountApplication(),
                "get_count_order" => $this->GetCountOrder(), "get_count_view_funnel" => $this->GetCountViewFunnel()];
            if (empty($result)) {
                echo '';
            }
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