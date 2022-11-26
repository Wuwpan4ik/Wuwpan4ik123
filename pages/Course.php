<?php
class Course extends ACoreCreator {
    public function get_content() {
        $result = $this->m->getContentForCoursePage();
        return $result;
    }
}