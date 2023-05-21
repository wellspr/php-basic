<?php

namespace RouterClass;

class Router {
    public $request_uri;
    public $pages;
    public $request_array;
    public $request_array_length;

    function __construct($request_uri)
    {
        $this->request_uri = $request_uri;
        $this->pages = scandir("pages/");
        $this->request_array = explode("/", ltrim($this->request_uri, "/"));
        $this->request_array_length = count($this->request_array);
    }

    function uri() 
    {
        return $this->request_uri;
    }

    function pages()
    {
        return $this->pages;
    }

    protected function render_page($page) 
    {
        if (in_array($page, $this->pages)) {
            require "pages/" . $page;
        } else {
            require "error_pages/404.php";
        }
    }

    function page_title() 
    {
        $name = $this->request_array[$this->request_array_length-1];
        if (strlen($name) > 0) {
            echo "PHP Projects Hub | " . ucfirst($name);
        } else {
            echo "PHP Projects Hub | Home";
        }
    }

    function path() 
    {
        $path = 
            $this->request_array_length>1 ? 
            $this->request_array[1] : 
            "";
            
        if ($this->request_array_length > 1) {
            return $path;
        } else {
            return null;
        }
    }

    function routes() 
    {
        $page = $this->request_array[0] . ".php";

        if ($this->request_array_length === 1) {
            if ($this->request_uri === "/") {
                require "pages/home.php";
            } else {
                $this->render_page($page);
            }
        } else if ($this->request_array_length === 2) {
            $this->render_page($page);
        } else {
            require "error_pages/404.php";
        }
    }
}
