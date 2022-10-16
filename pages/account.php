<?php
class Account extends ACore
{
    public function get_content() {
        $result = $this->m->getCurrentUser();
		$tar = $this->m->getTariffs();
        return $content = [$result, $tar];
    }
}
