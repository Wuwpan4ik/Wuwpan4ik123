<?php

class AnalyticController extends ACoreCreator
{

    public function DeleteAllClients()
    {
        $items_id = explode(",", $_POST['items_id']);
        $items_id_array = [];
        foreach ($items_id as $item) {
            array_push($items_id_array, $item);
        }
        $this->m->db->execute("DELETE FROM `clients` WHERE `id` IN (" . implode(',', $items_id_array) . ")");
    }

    public function DeleteAllOrders()
    {
        $items_id = explode(",", $_POST['items_id']);
        $items_id_array = [];
        foreach ($items_id as $item) {
            array_push($items_id_array, $item);
        }
        $this->m->db->execute("DELETE FROM `orders` WHERE `id` IN (" . implode(',', $items_id_array) . ")");
    }

    function get_content()
    {
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }

}