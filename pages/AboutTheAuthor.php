<?php
class AboutTheAuthor extends ACoreGuess {
    function get_content()
    {
        return $this->user->getAuthorInfo();
    }
}
