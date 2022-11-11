<?php
class Account extends ACoreCreator
{
    public function get_content() {
        $result = $this->m->getCurrentUser();
        $content = $this->m->getTariffs();
        return [$result, $content];
    }

}
