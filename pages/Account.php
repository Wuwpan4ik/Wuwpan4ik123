<?php
class Account extends ACoreCreator
{
    public function get_content() {
        $content = $this->m->getTariffs();
        $user_info = $this->m->CheckInfoTariff();
        $urls = $this->m->TakeSocialUrls();
        return [$content, $user_info['file_size'], $urls];
    }

}
