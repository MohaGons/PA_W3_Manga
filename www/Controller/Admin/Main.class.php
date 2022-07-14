<?php

namespace App\Controller\Admin;

use App\Model\User as UserModel;
use App\Model\Role as RoleModel;
use App\Core\View;
use App\Core\Verificator;
use MongoDB\BSON\Decimal128;
use App\Repository\Forum as ForumRepository;
use App\Repository\Event as EventRepository;
use App\Repository\User as UserRepository;

class Main
{

    public function home()
    {
        $forums_data = ForumRepository::all();
        $event_data = EventRepository::all();
        $users = UserRepository::all();
        $recent_event = EventRepository::getRecentEvent();
        $recent_forum = ForumRepository::getRecentForum();

        $view = new View("admin/home", "back");
        $view->assign("forums_data", $forums_data);
        $view->assign("event_data", $event_data);
        $view->assign("users", $users);
        $view->assign("recent_event", $recent_event);
        $view->assign("recent_forum", $recent_forum);
    }


}
