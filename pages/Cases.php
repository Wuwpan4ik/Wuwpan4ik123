<?php
    class Cases extends ACoreCreator {
        function get_content()
        {
            $cases = $this->cases_class->GetAllQuery('cases');
            return ['cases' => $cases];
        }
    }
