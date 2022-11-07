<?php
class UserMenu extends ACore
{
    public function get_content() {

		$result = $this->m->getCountUserNotifications();
        return $result;
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}