<?php
class CourseEdit extends ACore {
    public function get_content() {
        $result = $this->m->getContentForCourseEdit();
        return $result;
    }

    public function obr() {}
}