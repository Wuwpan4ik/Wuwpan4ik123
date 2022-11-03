<?php
    class CourseController extends VideoController {

        public function __construct()
        {
            $this->group = 'course';
            $this->group_content = 'course_content';
        }

        function get_content()
        {
        }

        function obr()
        {
        }
    }
?>