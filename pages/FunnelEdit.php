<?php
class FunnelEdit extends ACoreCreator {
    public function get_content() {
        $result = $this->m->getContentForFunnelEdit();
        return $result;
    }

    public function obr() {}
}