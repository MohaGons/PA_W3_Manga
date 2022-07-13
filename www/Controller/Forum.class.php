<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Forum as ForumsModel;
use App\Model\CommentaireForum as ForumCommentaireModel;
use App\Repository\Forum as ForumRepository;

class Forum 
{
    public function index()
    {
        $forums_data = ForumRepository::all();
        
        $view = new View("forum_index");
        $view->assign("forums_data", $forums_data);
    }

    public function detail($id)
    {   
        $forum_Id = $id[1];

        $forum = new ForumsModel();
        $forum_data = ForumRepository::findById($forum_Id);
        $view = new View("forum", "front");
        $view->assign("forum", $forum);

        $view->assign("forum_data", $forum_data);
    }
}