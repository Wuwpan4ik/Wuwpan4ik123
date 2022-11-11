<?php

class Router
{
    private $pages = array();

    function addRoute($url, $path, $method = null) {
        if (is_null($method)) {
            $this->pages[$url] = $path;
        } else {
            $this->pages[$url] = [$path, $method];
        }
    }

    function route($url) {
        $path = $this->pages[$url];

        if (is_array($path)) {
            $method = $path[1];
            $path = $path[0];
        }

        $controller_url = "controller/".$path;
        $pages_url = "pages/".$path;
        $template_url = "template/".$path;

        if (file_exists($pages_url)) {
            $class = substr($path, 0, -4);
            if (class_exists($class)) {
                $obj = new $class;
                if (method_exists($obj, "obr")) {
                    $obj->obr();
                }
                $content = $obj->get_content();
                require $template_url;
            }
        } else if (file_exists($template_url)) {
            require $template_url;
        }

        if (file_exists($controller_url)) {
            $class = substr($path, 0, -4);
            if (class_exists($class)) {
                $obj = new $class;
                if (method_exists($obj, $method)) {
                    $obj->$method();
                    $obj->get_content();
                }
            }
        }
    }
}