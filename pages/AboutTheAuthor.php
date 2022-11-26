<?php
class AboutTheAuthor extends ACoreGuess {
    function get_content()
    {
        return $this->m->getAuthorInfo();
    }
}
