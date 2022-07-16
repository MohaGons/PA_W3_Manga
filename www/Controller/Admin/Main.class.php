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
use App\Repository\Page as PageRepository;
use App\Repository\ForumCommentaire as ForumCommentaireRepository;

class Main
{

    public function home()
    {
        $forums_data = ForumRepository::all();
        $event_data = EventRepository::all();
        $page_data = PageRepository::all();
        $users = UserRepository::all();
        $recent_event = EventRepository::getRecentEvent();
        $get_recent_category_forum = ForumRepository::getRecentCategoryForum();
        $forum_commentaire = ForumCommentaireRepository::getInformationsForumCommentaire();

        $view = new View("admin/home", "back");
        $view->assign("forums_data", $forums_data);
        $view->assign("event_data", $event_data);
        $view->assign("users", $users);
        $view->assign("recent_event", $recent_event);
        $view->assign("page_data", $page_data);
        $view->assign("get_recent_category_forum", $get_recent_category_forum);
        $view->assign("forum_commentaire", $forum_commentaire);
    }
    public function Template()
    {
        $view = new View("admin/template", "back");
    }


}
