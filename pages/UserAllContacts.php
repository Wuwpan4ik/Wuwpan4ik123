<?php
class UserAllContacts extends ACoreGuess
{
    public function get_content() {
        $author_page = $this->user_class->getContentForUserAuthorPage();
        return ['author_page' => $author_page];
    }
}
