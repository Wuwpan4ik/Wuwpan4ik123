<?php
    class UserMenu extends ACore {

        function get_content()
        {
            $result = $this->m->getCountUserNotifications();
            return $result;
        }

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }
