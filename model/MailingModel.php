<?php
    class MailingModel extends ConnectDatabase
    {
        public function Get($where = null)
        {
            if (is_null($where)) {
                return $this->db->query("SELECT * FROM mailing WHERE id = {$_SESSION['item_id']}")[0];
            } else {
                return $this->db->query("SELECT * FROM mailing WHERE " . array_keys($where)[0] . " = " . $where[array_keys($where)[0]])[0];
            }
        }
    }