<?php
class FunnelEdit extends ACore {
    public function get_content() {
        $result = $this->m->getContentForFunnelEdit();
        return $result;
    }

    public function obr() {
        return ($_SESSION['user']['id'] == $this->m->db->query("SELECT * FROM funnel WHERE id = ".$_GET['id'])[0]['author_id']);
    }
}