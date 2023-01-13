<?php

class TariffController extends ACoreCreator
{
    public function Buy()
    {   
        $user_id = $_SESSION['user']['id'];
        $tariff_id = $_POST['tariff_id'];
        if ($this->m->BuyTariff($user_id, $tariff_id)) {
            $this->addNotifications("item-like", 'Вы успешно оформили тарифф', '/img/Notification/message.png', $user_id);
        }

        $_SESSION['user']['tariff'] = $tariff_id;
        $this->get_content();
    }

    public function get_content()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    

}