<?php
class SmallPlayer extends ACoreAdmin
{
    public function get_content() {
//        Проверка на покупку
        $content = $this->db->getVideosForPlayer();
        return $content;
    }

    public function obr()
    {
        if (!$this->db->GetTariff($_SESSION['user']['id'])) {
            header("Location: /Tariff-absent");
        }
    }
}