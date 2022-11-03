<?php
class FunnelEdit extends ACore {
    public function get_content() {
        $result = $this->m->getContentForFunnelEdit();
        return $result;
    }

    public function obr() {}
}