<?php
class SmallPlayer extends ACore
{
    public function get_content() {
        $content = $this->m->getVideosForPlayer();
        return $content;
    }
}