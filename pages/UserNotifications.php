<?php
class UserNotifications extends ACoreGuess
{
    public function get_content() {
        return $this->m->getNotifications($_SESSION['user']['id']);
    }
}