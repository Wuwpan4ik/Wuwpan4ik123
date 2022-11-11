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

        public function GetAllStatistics() {
            $result = ["prev_week" => $this->GetPrevWeekStatistics(), "week" => $this->GetWeekStatistics(),
                "prev_month" => $this->GetPrevMonthsStatistics(), "month" => $this->GetMonthsStatistics(), "full_value" => $this->m->GetFullValue()];
            echo json_encode($result);
        }

        public function GetWeekGraph()
        {
            $result = ['prev' => $this->m->GetWeekGraph()];
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