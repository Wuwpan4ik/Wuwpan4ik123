<?php
class CourseEdit extends ACoreCreator {
    public function get_content() {
        return $this->user_class->GetContentForCourseEdit();
    }
}