<?php

namespace App\Controller\Admin;

use App\Core\Security as Security;
use App\Core\Verificator;
use App\Core\View;
use App\Model\ForumCommentaire as ForumCommentaireModel;
use App\Repository\ForumCommentaire as ForumCommentaireRepository;

class Forumcommentaire
{
    public function index()
    {
        $forum_commentaire = ForumCommentaireRepository::getInformationsForumCommentaire();
        $forum_commentaire_valid = ForumCommentaireRepository::getInformationsForumCommentaireValid();
        $NbForumCommentaire = count(ForumCommentaireRepository::all());
        
        $view = new View("admin/forumcommentaire_index", "back");
        $view->assign("forum_commentaire", $forum_commentaire);
        $view->assign("forum_commentaire_valid", $forum_commentaire_valid);
        $view->assign("NbForumCommentaire", $NbForumCommentaire);
    }

    public function edit($id) {

        $forum_commentaire_Id = $id[0];

        if (!empty($forum_commentaire_Id) && is_numeric($forum_commentaire_Id))
        {
            $forum_commentaire = new ForumCommentaireModel();
            $forum_commentaire_data = ForumCommentaireRepository::findById($forum_commentaire_Id);

            $forum_commentaire->setId($forum_commentaire_Id);
            $forum_commentaire->setForumId($forum_commentaire_data[0]["id_forum"]);
            $forum_commentaire->setUserId($forum_commentaire_data[0]["id_user"]);
            $forum_commentaire->setCommentaire($forum_commentaire_data[0]["commentaire"]);
            $forum_commentaire->setCreatedAt(date("Y-m-d H:i:s"));
            $forum_commentaire->setIsValid(1);
            $forum_commentaire->save();

            $view = new View("forumcommentaire", "back");
            $view->assign("forum_commentaire", $forum_commentaire);
            header("Location: /admin/forumcommentaire");
        }
        else {
            Security::returnHttpResponseCode(404);
        }

    }

    public function delete($id)
    {
        $forum_commentaire_Id = $id[0];

        if (!empty($forum_commentaire_Id) && is_numeric($forum_commentaire_Id))
        {
            $forum_commentaire_delete = ForumCommentaireRepository::delete($forum_commentaire_Id);
            header("Location: /admin/forumcommentaire");
        }
        else {
            Security::returnHttpResponseCode(404);
        }
    }

}
