<?php

class TariffController extends ACoreCreator
{
    public function Buy()
    {   
        $user_id = $_SESSION['user']['id'];
        $tariff_id = $_POST['tariff_id'];
        if ($this->m->BuyTariff($user_id, $tariff_id)) {
            $tariff_name = $this->m->GetTariff($user_id);
            $date = date("d.m.Y", strtotime($tariff_name[0]['date']));
            $this->addNotifications("Тариф “{$tariff_name[0]['name']}” подключен", "Теперь ваш аккаунт получил все доступные функции до $date", '/img/Notification/cart.svg','item-like', $user_id);
        }

        $_SESSION['user']['tariff'] = $tariff_id;
        $this->get_content();
    }

    public function get_content()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    

}