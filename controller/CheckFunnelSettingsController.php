<?php

class CheckFunnelSettingsController extends FunnelController
{

    public function CheckPopupSettings()
    {
        $popup_settings = $this->CreatePopupSettings();
        $videoBtnHTMLResult = str_replace('\/', '/', json_encode($popup_settings['json'], JSON_UNESCAPED_UNICODE));
        $saveVersion = $this->m->db->query("SELECT * FROM funnel_content WHERE id = {$_SESSION['item_id']}")[0]['popup'];
        if ($videoBtnHTMLResult == $saveVersion) {
            echo $saveVersion;
        } else {
            echo 0;
        }
    }

    public function CheckMainSettings()
    {
        $popup_settings = $this->CreateMainSettings();
        $videoBtnHTMLResult = str_replace('\/', '/', json_encode($popup_settings['json'], JSON_UNESCAPED_UNICODE));
        $saveVersion = $this->m->db->query("SELECT * FROM funnel WHERE id = {$_SESSION['item_id']}")[0]['style_settings'];
        if (!is_null($saveVersion) && ($videoBtnHTMLResult == $saveVersion)) {
            echo $saveVersion;
        } else {
            echo 0;
        }
    }

    function get_content()
    {
    }

    function local_get_content()
    {
    }


    function obr()
    {
    }
}