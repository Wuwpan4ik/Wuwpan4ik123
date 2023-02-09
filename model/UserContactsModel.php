<?php
    class UserContactsModel extends ConnectDatabase {

        public function getContactsByUser()
        {
            return $this->db->query("SELECT user.id, user.telephone, user.email, contact.vk, contact.instagram, contact.whatsapp, contact.telegram, contact.facebook, contact.youtube, contact.twitter, contact.site FROM user LEFT JOIN user_contacts as contact ON contact.user_id = user.id WHERE user.id = " . $_SESSION['item_id']);
        }

        public function getCurrentUserContacts()
        {
            return $this->db->query("SELECT * FROM `user_contacts` WHERE `user_id` = {$_SESSION['user']['id']}");
        }

        public function UserHaveAContacts()
        {
            $flag = false;
            foreach ($this->db->query("SELECT us.vk, us.instagram, us.whatsapp, us.telegram, us.facebook, us.youtube, us.twitter, us.site FROM user_contacts `us` WHERE user_id = {$_SESSION['item_id']}")[0] as $item) {
                if (!is_null($item)) {
                    $flag = true;
                }
            }
            return $flag;
        }

        public function isUserSocials()
        {
            return count($this->db->query("SELECT * FROM `user_contacts` WHERE `user_id` = " . $_SESSION['user']['id'])) == 1;
        }

        public function TakeSocialUrls()
        {
            return $this->db->query("SELECT * FROM `user_contacts` WHERE `user_id` = " . $_SESSION['user']['id']);
        }
    }