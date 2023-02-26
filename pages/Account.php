<?php
class Account extends ACoreCreator
{
    public function get_content() {
        $content = $this->tariff_class->getTariffs();
        $user_info = $this->tariff_class->CheckInfoTariff();
        $tariff_date = $this->tariff_class->GetTariff($_SESSION['user']['id']);
        $urls = $this->user_contacts->TakeSocialUrls();
        $count_users = $this->statistic_class->GetCountClients();

        $tariffs_link = [];
        foreach ($content as $item) {
            $_SESSION['product_key'] = $item['id'];
            array_push($tariffs_link, $this->tariff_class->MakeLinkForBuyInProdamus());
        }
        return [$content, (int) $user_info['file_size'], $urls, $tariff_date, $count_users, $tariffs_link];
    }

}
