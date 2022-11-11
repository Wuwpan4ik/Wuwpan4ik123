<?php
class UserMain extends ACoreGuess
{
    public function get_content() {
        $author_page = $this->m->getContentForUserAuthorPage();
        return ['author_page' => $author_page];
    }
}
