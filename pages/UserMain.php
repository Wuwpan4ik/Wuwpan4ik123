<?php
    class UserMain extends ACore {

        function get_content()
        {
            $content = $this->m->getVideosForPlayer();
            return $content;
        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }