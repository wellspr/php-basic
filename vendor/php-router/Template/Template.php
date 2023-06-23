<?php

namespace Template;

use Error;

class Template
{
    private $smarty;

    function __construct()
    {
        if (isset($GLOBALS['smarty'])) {
            $this->smarty = $GLOBALS['smarty'];
        } else {
            throw new Error("Smarty global variable not set.");
        }
    }

    function set_template(string $path): void
    {
        $this->smarty->assign('template_main', file_get_contents($path));
    }

    function set_var($name, $var): void
    {
        $this->smarty->assign($name, $var);
    }

    function get_args($args): void
    {
        $keys = array_keys($args);

        foreach ($keys as $key) {
            $this->set_var($key, $args[$key]);
        }
    }

    function output(): void
    {
        $this->smarty->display("index.tpl");
    }

    function error_page(): void
    {
        $this->set_var("title", "404 error");
        $this->set_var("code", "404");
        $this->set_var("message", "page not found error");
        $this->smarty->display(__DIR__."/../templates/error.tpl");
    }
}
