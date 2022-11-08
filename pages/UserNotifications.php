<?php
class UserNotifications extends ACore
{
    public function get_content() {
		$result = $this->m->getUserNotifications();
        return $result;
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}