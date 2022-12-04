<?php
class UserContacts extends ACoreGuess
{
    public function get_content() {
        $result = ["contacts" => $this->m->getContactsByUser(), "is_contacts" => $this->m->UserHaveAContacts()];
        return $result;
    }
}
