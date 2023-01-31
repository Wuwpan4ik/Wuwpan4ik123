<?php
class Funnel extends ACoreCreator {
    public function get_content() {
        $result = $this->user_class->GetContentForFunnelPage();
        $course_list = $this->user->getCourseUser();
        $tariff_count = $this->CheckTariff();
        return [$result, $course_list, $tariff_count[0]['funnel_count']];
    }

    public function obr()
    {
        if (!$this->tariff_class->GetTariff($_SESSION['user']['id'])) {
            header("Location: /Tariff-absent");
        }
    }
}