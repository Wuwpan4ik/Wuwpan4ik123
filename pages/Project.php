<?php
class Project extends ACoreCreator {
    public function get_content() {
        $result = $this->m->CheckInfoTariff();
        $tariff = $this->m->CheckTariff();
        $_SESSION['error'] = $tariff;
        return ['count_funnel' => count($result['funnel_count']), 'count_course' => count($result['course_count']),
            'max_count_funnel' => $tariff[0]['funnel_count'], 'max_count_course' => $tariff[0]['course_count']];
    }
}