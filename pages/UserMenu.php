<?php
    class UserMenu extends ACoreGuess {

        function get_content()
        {
            $result = $this->m->getCountUserNotifications();
            return $result;
        }
    }
