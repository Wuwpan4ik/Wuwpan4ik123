<?php
class ProjectEdit extends ACore {
    public function get_content() {
        $result = $this->m->getContentForProjectEdit();
        return $result;
    }

    public function obr() {}
}