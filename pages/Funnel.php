<?php
class Funnel extends ACoreCreator {
    public function get_content() {
        $result = $this->m->getContentForFunnelPage();
        $course_list = $this->m->getCourseUser();
        $tariff_count = $this->CheckTariff();
        return [$result, $course_list, $tariff_count[0]['funnel_count']];
    }

    public function obr()
    {
        if (!$this->m->GetTariff($_SESSION['user']['id'])) {
            header("Location: /Tariff-absent");
        }
    }
}