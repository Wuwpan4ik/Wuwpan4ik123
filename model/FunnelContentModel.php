<?php
    class FunnelContentModel extends ConnectDatabase {
        use CheckDirSize;

        public function Get($where = null)
        {
            if (is_null($where)) {
                return $this->db->query("SELECT * FROM funnel_content WHERE id = {$_SESSION['item_id']}");
            } else {
                return $this->db->query("SELECT * FROM funnel_content WHERE " . array_keys($where)[0] . " = " . $where[array_keys($where)[0]]);
            }
        }

        public function GetView($id)
        {
            $count = $this->db->query("SELECT `count_view` FROM `funnel_content` WHERE id = '$id'")[0]['count_view'];
            return $count;
        }

        public function AddView($id, $count)
        {
            $count += 1;
            $this->db->execute("UPDATE `funnel_content` SET `count_view`  = {$count} WHERE id = {$id}");
            return true;
        }

        public function GetVideoAndAuthorId($id)
        {
            return $this->db->query("SELECT funnel.author_id, funnel_content.video FROM `funnel_content` INNER JOIN `funnel` ON funnel.id = funnel_content.funnel_id WHERE funnel_content.id = $id");
        }

        public function GetForChangeVideo($uid)
        {
            return $this->db->query("SELECT funnel.author_id, funnel_content.funnel_id, funnel_content.video FROM `funnel_content` INNER JOIN `funnel` ON funnel.id = funnel_content.funnel_id WHERE funnel_content.id = '$uid'");

        }
    }