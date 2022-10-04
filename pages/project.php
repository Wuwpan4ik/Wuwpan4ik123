<?php
class Project extends ACore {
    public function get_content() {
        $result = $this->m->getAllProjects();
        return $result;
    }

    public function obr() {}
}