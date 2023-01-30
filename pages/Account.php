<?php
class Account extends ACoreCreator
{
    public function get_content() {
        $content = $this->m->getTariffs();
        $user_info = $this->m->CheckInfoTariff();
        $tariff_date = $this->m->GetTariff($_SESSION['user']['id']);
        $urls = $this->m->TakeSocialUrls();
        $count_users = $this->statistic_class->GetCountClients();
        return [$content, (int) $user_info['file_size'], $urls, $tariff_date, $count_users];
    }

}
