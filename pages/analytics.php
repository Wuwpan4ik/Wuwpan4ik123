<?php
class Analytics extends ACore
{
    public function get_content() {
		$result = $this->m->getClientList();
        return $result;
	}

    function obr()
    {
        // TODO: Implement obr() method.
    }
}
