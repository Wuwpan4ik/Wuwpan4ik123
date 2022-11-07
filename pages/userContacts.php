<?php
class UserContacts extends ACore
{
    public function get_content() {
		$result = $this->m->getCourseAuthor();
        return $result;
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}
