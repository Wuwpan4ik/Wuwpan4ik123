<?php
class CourseEdit extends ACoreCreator {
    public function get_content() {
        $result = $this->m->getContentForCourseEdit();
        return $result;
    }

    public function obr() {

    }
}