<?php
class Funnel extends ACore {
    public function get_content() {
        $result = $this->m->getContentForProjectPage();
        return $result;
    }

    public function obr() {}
}