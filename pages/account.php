<?php
class Account extends ACore
{
    public function get_content() {
        $result = $this->m->getCurrentUser();
        return $result;
        
        $content = $this->m->getTariffs();
        return $content;
    }
}
