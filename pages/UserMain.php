<?php
class UserMain extends ACore
{
    public function get_content() {
        $author_page = $this->m->getContentForUserAuthorPage();
        return ['author_page' => $author_page];
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}
