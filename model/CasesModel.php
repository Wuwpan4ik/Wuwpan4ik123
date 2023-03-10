<?php
    class CasesModel extends ConnectDatabase
    {
        public function GetCases()
        {
            $this->GetAllQuery('cases');
        }
    }