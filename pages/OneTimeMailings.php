<?php
    class OneTimeMailings extends ACoreCreator
    {
        function get_content()
        {
            $mailings = $this->mailing->GetMailingUser();
            return ["mailings" => $mailings];
        }
    }