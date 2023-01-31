<?php
class UserContacts extends ACoreGuess
{
    public function get_content() {
        $result = ["contacts" => $this->user_contacts->getContactsByUser(), "is_contacts" => $this->user_contacts->UserHaveAContacts()];
        return $result;
    }
}
