<?php

namespace Components\Layout;

class Menu {
    public $pages;

    function __construct($pages)
    {
        $this->pages = $pages;
    }

    function menu() 
    {
        $menu_items = array();
        $excluded = [".", "..", "home.php"];
        foreach ($this->pages as $page) {
            if (!in_array($page, $excluded)) {
                $name = rtrim($page, ".php");
                array_push($menu_items, $name);
            }
        }
        echo "<nav class='app__header__menu nav'>";
        foreach($menu_items as $item) {
            echo "<a href='/$item'>$item</a>";
        }
        echo "</nav>";
    }
}

class Footer {
    function footer_text() {
        $year = date("Y");
        echo "&copy; $year - The php projects hub";
    }
}