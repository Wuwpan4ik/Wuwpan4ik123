<?php
class CourseEdit extends ACoreCreator {
    public function get_content() {
        return $this->user_class->GetContentForCourseEdit();
    }

    public function obr()
    {
        if (empty($this->course->Get())) {
            header("Location: /error");
        }
    }
}