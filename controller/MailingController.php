<?php
    class MailingController extends ACoreCreator
    {
        public function Create()
        {
            $this->mailing->InsertQuery('mailing', ['name' => $_Po]);
        }

        public function Delete()
        {

        }

        public function Edit()
        {

        }
    }