<?php

class AnalyticController extends ACoreCreator
{
    public function DeleteClient() {
        $item_id = $_SESSION['item_id'];
        $query = $this->m->db->query("SELECT * FROM `clients` WHERE `creator_id` = " . $_SESSION['user']['id'] . " AND `id` = '$item_id'");
        if (count($query) != 1) {
            return false;
        }
        $this->m->db->execute("DELETE FROM `clients` WHERE `id` = '$item_id'");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return true;
    }

    public function DeleteOrder() {
        $item_id = $_SESSION['item_id'];
        $query = $this->m->db->query("SELECT * FROM `orders` WHERE `creator_id` = " . $_SESSION['user']['id'] . " AND `id` = '$item_id'");
        if (count($query) != 1) {
            return false;
        }
        $this->m->db->execute("DELETE FROM `orders` WHERE `id` = '$item_id'");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return true;
    }

    function get_content()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }

}