<?php
    class UrlController {
        protected $m;

        public function __construct()
        {
            $this->m = new User();
        }

        function get_content()
        {
            $site_url = $_GET['site_url'];
            if (strlen($site_url) == 0) {
                echo '<div style="color: orangered;">Поле не заполнено</div>';
                return False;
            }
            $count = (int)($this->m->db->query("SELECT * FROM user WHERE `site_url` = '$site_url'"));
            if ($count == 0) {
                echo '<div style="color: #37ea8c;">Такой Url не занят</div>';
            } else {
                echo '<div style="color: orangered;">Такой Url занят</div>';
            }
        }
    }