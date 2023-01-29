<?php
class UserMain extends ACoreGuess
{
    public function get_content() {
        $author_page = $this->m->getContentForUserAuthorPage();
        $get_API = $this->m->getAPIByUser($author_page[0]['id']);
        return ['author_page' => $author_page, 'get_API' => $get_API];
    }
}
