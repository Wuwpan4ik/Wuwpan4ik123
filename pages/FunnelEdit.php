<?php
class FunnelEdit extends ACoreCreator {
    public function get_content() {
        $result = $this->user_class->GetContentForFunnelEdit();
        return $result;
    }
}