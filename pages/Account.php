<?php
class Account extends ACoreCreator
{
    public function get_content() {
        $content = $this->tariff_class->getTariffs();
        $user_info = $this->tariff_class->CheckInfoTariff();
        $tariff_date = $this->tariff_class->GetTariff($_SESSION['user']['id']);
        $urls = $this->user_contacts->TakeSocialUrls();
        $count_users = $this->statistic_class->GetCountClients();
        return [$content, (int) $user_info['file_size'], $urls, $tariff_date, $count_users];
    }

}
