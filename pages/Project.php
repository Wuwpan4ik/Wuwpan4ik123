<?php
class Project extends ACore {
    public function get_content() {
        $funnel = $this->m->getContentForFunnelPage()[0];
        $count_funnel = count($funnel);
        $course = $this->m->getContentForCoursePage()[0];
        $count_course = count($course);
        return ['count_funnel' => $count_funnel, 'count_course' => $count_course];
    }

    public function obr() {}
}