<?php
class Account extends ACoreCreator
{
    public function get_content() {
        $content = $this->m->getTariffs();
        $files_size = $this->dir_size('./uploads/users/' . $_SESSION['user']['id']) / 1024 / 1024;
        $urls = $this->m->TakeSocialUrls();
        return [$content, $files_size, $urls];
    }

}
