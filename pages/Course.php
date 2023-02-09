<?php
class Course extends ACoreCreator {
    public function get_content() {
        $result = $this->user_class->GetContentForCoursePage();
        $tariff_count = $this->CheckTariff();
        return ['content' => $result, 'limit_course' => $tariff_count[0]['course_count']];
    }

    public function obr()
    {
        if (!$this->tariff_class->GetTariff($_SESSION['user']['id'])) {
            header("Location: /Tariff-absent");
        }
    }
}