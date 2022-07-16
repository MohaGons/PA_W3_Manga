<?php

namespace App\Controller\Admin;

use App\Core\Verificator;
use App\Core\View;
use App\Model\ForumCommentaire as ForumCommentaireModel;
use App\Repository\ForumCommentaire as ForumCommentaireRepository;

class ForumCommentaire
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

    public function delete($id)
    {
        $forum_commentaire_Id = $id[0];

        if (!empty($forum_commentaire_Id) && is_numeric($forum_commentaire_Id))
        {
            $forum_commentaire_delete = ForumCommentaireRepository::delete($forum_commentaire_Id);
            header("Location: /admin/forumcommentaire");
        }
    }

}
