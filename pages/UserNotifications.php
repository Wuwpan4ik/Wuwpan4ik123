<?php
class UserNotifications extends ACoreGuess
{
    public function get_content() {
        return $this->notifications->getNotifications($_SESSION['user']['id']);
    }
}