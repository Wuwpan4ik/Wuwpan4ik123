<?php
    class StatisticsController extends ACore {

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
            $result = ["prev_week" => $this->GetPrevWeekStatistics()[0]['give_money'], "week" => $this->GetWeekStatistics()[0]['give_money'],
                "prev_month" => $this->GetPrevMonthsStatistics()[0]['give_money'], "month" => $this->GetMonthsStatistics()[0]['give_money']];
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