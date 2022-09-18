<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\Session as Session;
use App\Core\View;
use App\Repository\Forum as ForumRepository;
use App\Repository\Page as PageRepository;
use App\Repository\ForumCommentaire as ForumCommentaireRepository;
use App\Model\ForumCommentaire as ForumCommentaireModel;

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
        $forum_commentaire = new ForumCommentaireModel();
        $forum_commentaire_valid = ForumCommentaireRepository::getInformationsForumCommentaireValidFront($forum_Id);


        $page_data = PageRepository::dataPage("forum", Session::get('id'));
        $forum_data = ForumRepository::findById($forum_Id);
        $view = new View("forum", "front");
        $view->assign("page_data", $page_data);
        $view->assign("forum_data", $forum_data);
        $view->assign("page_data", $page_data);
        $view->assign("forum_commentaire_valid", $forum_commentaire_valid);

    }

    public function create($id)
    {
        $forum_Id = $id[0];

        if (!empty($forum_Id) && is_numeric($forum_Id)){
        
            $forum_commentaire = new ForumCommentaireModel();
            $forum_data = ForumRepository::findById($forum_Id);
            $errors = [];

            if(!empty($_POST)) {

                $result = Verificator::checkForm($forum_commentaire->getCreateCommentaireForm(), $_POST);

                if (empty($result)) {
                    if (!empty($_POST["commentaire"])) {
                        $forum_commentaire->setCommentaire(htmlspecialchars($_POST["commentaire"]));
                    }
                    $forum_commentaire->setCreatedAt(date("Y-m-d H:i:s"));
                    $forum_commentaire->setForumId($forum_Id);
                    $forum_commentaire->setUserId(Session::get('id'));
                    $forum_commentaire->save();
                    echo "<script>alert('Votre commentaire a bien été ajouté. Il est en attente de validation.')</script>";
                } else {
                    $errors = $result;
                }

            }

            $view = new View("forum_commentaire", "front");
            $view->assign("forum_commentaire", $forum_commentaire);
            $view->assign("errors", $errors);
            $view->assign("forum_data", $forum_data);
        }

    }

}