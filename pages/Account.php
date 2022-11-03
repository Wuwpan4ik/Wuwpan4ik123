<?php
class Account extends ACore
{
    public function get_content() {
        $result = $this->m->getCurrentUser();
        $content = $this->m->getTariffs();
        return [$result, $content];
    }

    function obr()
    {
        // TODO: Implement obr() method.
    }
}
