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
        $user_id = $this->db->db->query("SELECT * FROM funnel WHERE id = {$_SESSION['item_id']}");
        if (!$this->db->GetTariff($user_id[0]['author_id'])) {
            header("Location: /Tariff-absent");
        }
    }
}