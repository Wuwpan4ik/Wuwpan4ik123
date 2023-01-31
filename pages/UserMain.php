<?php
class UserMain extends ACoreGuess
{
    public function get_content() {
        $author_page = $this->user_class->GetContentForUserAuthorPage();
        $get_API = $this->user->getAPIByUser($author_page[0]['id']);
        return ['author_page' => $author_page, 'get_API' => $get_API];
    }
}
