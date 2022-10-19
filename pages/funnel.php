<?php
class Funnel extends ACore {
    public function get_content() {
        $result = $this->m->getContentForFunnelPage();
        return $result;
    }

    public function obr() {}
}