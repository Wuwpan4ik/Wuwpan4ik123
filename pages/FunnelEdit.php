<?php
class FunnelEdit extends ACoreCreator {
    public function get_content() {
        $result = $this->user_class->GetContentForFunnelEdit();
        return $result;
    }

    public function obr()
    {
        if (empty($this->funnel->Get())) {
            header("Location: /error");
        }
    }
}