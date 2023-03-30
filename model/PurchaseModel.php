<?php
    class PurchaseModel extends ConnectDatabase
    {
	    public function GetSecretKey($id)
	    {
		    return $this->db->query("SELECT prodamus_key FROM `user_integrations` WHERE `user_id` = {$id}")[0]['prodamus_key'];
	    }
	
	    public function GetProdamusUrl($id)
	    {
		    return $this->db->query("SELECT prodamus_url FROM `user_integrations` WHERE `user_id` = {$id}")[0]['prodamus_url'];
		}
    }