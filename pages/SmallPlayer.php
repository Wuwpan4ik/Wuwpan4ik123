<?php
class SmallPlayer extends ACore
{
    public function get_content() {
//        Проверка на покупку
        $content = $this->m->getVideosForPlayer();
        return $content;
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}