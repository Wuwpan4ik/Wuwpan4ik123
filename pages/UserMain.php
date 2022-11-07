<?php
class UserMain extends ACore
{
    public function get_content() {
		$result = $this->m->getContentForUserCoursePage();
        return $result;
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}
