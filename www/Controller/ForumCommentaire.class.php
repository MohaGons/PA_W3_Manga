<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\CommentaireForum as ForumCommentaireModel;

class ForumCommentaire 
{

    public function forumcommentaire() {

        $forum_commentaire = new ForumCommentaireModel();

        if (!empty($_POST)) {

            $result = Verificator::checkFormRegister($forum_commentaire->getCommentaireForm(), $_POST);
            print_r($result);

            if (empty($result)) {
                $forum_commentaire->setCommentaire(htmlspecialchars($_POST["commentaire"]));
                $forum_commentaire->save();
                echo "<script>alert('Votre commentaire a bien été ajouté')</script>";
            }

        }

        if (isset($_GET['id'])) {
            $search = $_GET['commentaire'];
            $users = $user->validCommentaire($search);
        }

        $view = new View("forumcommentaire", "back");
        $view->assign("forumcommentaire", $forum_commentaire);

        $forum_commentaire_data = $forum_commentaire->getAllCommentairesNoValid();
        $view->assign("forum_commentaire_data", $forum_commentaire_data);
    }
}