<?php

namespace App\Controller;

use App\Core\View;

class Main{

    public function home()
    {
        echo "Welcome";
        $view = new View("accueil");
    }


    public function contact()
    {
        $view = new View("contact");
    }
}