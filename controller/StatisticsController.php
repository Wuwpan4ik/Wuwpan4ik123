<?php
    class StatisticsController extends ACoreCreator {

        function GetMonthsStatistics(){
            return $this->statistic_class->GetMonthValue();
        }

        function GetPrevMonthsStatistics(){
            return $this->statistic_class->GetPrevMonthValue();
        }

        function GetWeekStatistics(){
            return $this->statistic_class->GetWeekValue();
        }

        function GetPrevWeekStatistics(){
            return $this->statistic_class->GetPrevWeekValue();
        }

        function GetOneUserValue(){
            return $this->statistic_class->GetOneUserValue();
        }

        function GetCountFirstBuy() {
            return $this->statistic_class->GetCountFirstBuy();
        }

        function GetCountApplication() {
            return $this->statistic_class->GetCountApplication();
        }

        function GetCountOrder() {
            return $this->statistic_class->GetCountOrder();
        }

        function GetCountViewFunnel() {
            return $this->statistic_class->GetCountViewFunnel();
        }

        public function GetWeekDays()
        {
            $result = $this->statistic_class->GetWeekDays();
            echo json_encode($result);
        }

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

        function get_content()
        {
            // TODO: Implement get_content() method.
        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }