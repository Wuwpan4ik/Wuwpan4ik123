<?php
class Main extends ACore {

    public function get_content() {
        $content = $this->m->getAllUsers();
        return $content;
    }

    public function obr() {}
}