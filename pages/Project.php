<?php
class Project extends ACoreCreator {
    public function get_content() {
        $result = $this->tariff_class->CheckInfoTariff();
        $tariff = $this->CheckTariff();
        $funnel_count = is_null($tariff[0]['funnel_count']) ? 0 : $tariff[0]['funnel_count'];
        $course_count = is_null($tariff[0]['course_count']) ? 0 : $tariff[0]['course_count'];
        return ['count_funnel' => count($result['funnel_count']), 'count_course' => count($result['course_count']),
            'max_count_funnel' => $funnel_count, 'max_count_course' => $course_count];
    }
}