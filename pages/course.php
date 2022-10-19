<?php
class Course extends ACore {
    public function get_content() {
        $result = $this->m->getContentForCoursePage();
        return $result;
    }

    public function obr() {}
}