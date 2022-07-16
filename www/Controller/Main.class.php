<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session as Session;

class Main
{

    public function home()
    {
        $role = Session::get("role");
        $view = new View("accueil");
        $view->assign("role", $role);
    }

    public function contact()
    {
        $view = new View("contact");
    }
}
