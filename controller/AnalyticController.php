<?php

class AnalyticController extends ACoreCreator
{

    public function DeleteAllClients()
    {
        $this->clients->DeleteQuery("clients", $_POST['items_id']);
    }

    public function DeleteAllOrders()
    {
        $this->orders->DeleteQuery("orders", $_POST['items_id']);
    }

    function get_content()
    {
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }

}