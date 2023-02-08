<?php
    class ArticleModel extends ConnectDatabase {
        public function Get($where = null)
        {
            if (is_null($where)) {
                return $this->db->query("SELECT * FROM cases WHERE id = {$_SESSION['item_id']}");
            } else {
                return $this->db->query("SELECT * FROM cases WHERE " . array_keys($where)[0] . " = " . $where[array_keys($where)[0]]);
            }
        }
    }