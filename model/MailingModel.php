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

        public function GetMailingUser()
        {
            return $this->GetQuery('mailing', ['user_id' => $_SESSION['user']['id']]);
        }

        public function Create($data)
        {
            $this->InsertQuery('mailing', $data);
        }

        public function Edit($data)
        {
            $this->UpdateQuery('mailing', $data, "WHERE id = {$data['id']}");
        }

        public function GetUsersByIndexs($id)
        {
            return $this->ClearQuery("SELECT email, ANY_VALUE(buy_progress) as 'buy_progress' FROM clients WHERE creator_id = {$_SESSION['user']['id']} GROUP BY email HAVING buy_progress >= $id");
        }
    }