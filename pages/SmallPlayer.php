<?php
class SmallPlayer extends ACoreAdmin
{
    public function get_content() {
//        Проверка на покупку
        $content = $this->db->getVideosForPlayer();
        return $content;
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}