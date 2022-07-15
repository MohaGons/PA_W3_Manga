<?php

namespace App\Controller;

use App\Core\Session as Session;
use App\Core\View;
use App\Repository\Forum as ForumRepository;
use App\Repository\Page as PageRepository;

class Frontforum
{
   public function FrontForum()
   {
    $forums_data = ForumRepository::all();
    $get_category_forum = ForumRepository::getCategoryForum();
    
    $page_data = PageRepository::dataPage("forum", Session::get('id'));
    $view = new View("front-forum");
    $view->assign("forums_data", $forums_data);
    $view->assign("get_category_forum", $get_category_forum);
    $view->assign("page_data", $page_data);
   }

   public function detail($id)
    {   
        $forum_Id = $id[1];

        $forum_data = ForumRepository::findById($forum_Id);
        $view = new View("forum", "front");

        $view->assign("forum_data", $forum_data);
    }

}