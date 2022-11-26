<?php
class Account extends ACoreCreator
{
    public function get_content() {
        $result = $this->m->getCurrentUser();
        $content = $this->m->getTariffs();
        $files_size = $this->dir_size('./uploads/users/' . $_SESSION['user']['id']) / 1024 / 1024;
        return [$result, $content, $files_size];
    }

}
