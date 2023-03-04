<?php
    class FunnelModel extends ConnectDatabase {
        use CheckDirSize;

        public function Get($where = null)
        {
            if (is_null($where)) {
                return $this->db->query("SELECT * FROM funnel WHERE id = {$_SESSION['item_id']}");
            } else {
                return $this->db->query("SELECT * FROM funnel WHERE " . array_keys($where)[0] . " = " . $where[array_keys($where)[0]]);
            }
        }

        public function GetLast($author_id)
        {
            return $this->db->query("SELECT * FROM funnel WHERE author_id = '$author_id'  ORDER BY ID DESC LIMIT 1");
        }

        public function GetView($id)
        {
            $count = $this->db->query("SELECT `views` FROM `funnel` WHERE id = '$id'")[0]['views'];
            return $count;
        }

        public function AddView($id, $count)
        {
            $count += 1;
            $this->db->execute("UPDATE `funnel` SET `views`  = {$count} WHERE id = {$id}");
            return true;
        }

        public function GetStyleSettings()
        {
            $style = $this->db->query("SELECT style_settings FROM funnel WHERE id = {$_SESSION['item_id']}")[0]["style_settings"];
            $html_code = $this->db->query("SELECT html_code FROM funnel WHERE id = {$_SESSION['item_id']}")[0]["html_code"];
            $decode_style = json_decode($style, true);
            $decode_style['html_code'] = $html_code;
            print_r(json_encode($decode_style));
        }
    }