<?php
class Funnel extends ACoreCreator {
    public function get_content() {
        $result = $this->m->getContentForFunnelPage();
        $course_list = $this->m->getCourseUser();
        return [$result, $course_list];
    }

    public function obr() {
    }
}