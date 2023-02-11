<?php
    class Article extends ACoreCreator {
        public function get_content() {
            $article = $this->article->Get()[0];
            return ["article" => $article];
        }

        public function obr()
        {
            if (empty($this->article->Get())) {
                header("Location: /error");
            }
        }
    }
