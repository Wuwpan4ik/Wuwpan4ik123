<?php
class CourseEdit extends ACore {
    public function get_content() {
        $result = $this->m->getContentForCourseEdit();
        return $result;
    }

    public function obr() {
        return ($_SESSION['user']['id'] == $this->m->db->query("SELECT * FROM course WHERE id = ".$_GET['id'])[0]['author_id']);
    }
}