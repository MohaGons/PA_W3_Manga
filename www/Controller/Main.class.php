<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session as Session;
use App\Repository\Event as EventRepository;

class Main
{

    public function home()
    {
        $role = Session::get("role");
        $recent_event = EventRepository::getRecentEvent();
        $view = new View("accueil");
        $view->assign("role", $role);
        $view->assign("recent_event", $recent_event);
    }

    public function contact()
    {
        $view = new View("contact");
    }
}
