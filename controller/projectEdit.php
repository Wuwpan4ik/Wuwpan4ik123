<?php
class ProjectEdit extends ACore {
    public function get_content() {
        $result = $this->m->getContentProjectEdit();
        return $result;
    }

    public function obr() {}
}