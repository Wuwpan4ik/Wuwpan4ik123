<?php
    class NewMailing extends ACoreCreator {
        function get_content()
        {
            $mailing = $this->mailing->Get();
            $mailing["buttons"] = json_decode($mailing['buttons'], 1);
            return $mailing;
        }

        function obr()
        {
            $mail = $this->mailing->Get();
            if ((empty($mail) || $mail['user_id'] != $_SESSION['user']['id']) && $_SESSION['item_id']) header("Location: /error");
        }
    }