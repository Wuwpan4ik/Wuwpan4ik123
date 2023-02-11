<?php
    class Cases extends ACoreCreator {
        function get_content()
        {
            $cases = $this->article->GetAll()[0];
            return ['cases' => $cases];
        }
    }
