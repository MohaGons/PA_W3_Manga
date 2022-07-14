<?php

namespace App\Repository;

use App\Model\ForumCommentaire as ForumCommentaireModel;
use App\Core\ConnectionPDO;

class ForumCommentaire {

    public static function all()
    {
        $forumCommentaireModel = new ForumCommentaireModel();
        $connectionPDO = new ConnectionPDO();

        $forumCommentaireModel->select(["*"]);
        $forumCommentaireModel->where("isValid", "=0");
        $req = $connectionPDO->pdo->prepare($forumCommentaireModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function findById($id)
    {
        $forumCommentaireModel = new ForumCommentaireModel();
        $connectionPDO = new ConnectionPDO();

        $forumCommentaireModel->select(["*"]);
        $forumCommentaireModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($forumCommentaireModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function delete($id) 
    {
        $forumCommentaireModel = new ForumCommentaireModel();
        $connectionPDO = new ConnectionPDO();

        $forumCommentaireModel->delete();
        $forumCommentaireModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($forumCommentaireModel->getQuery());
        $req->execute();

        return  $req;
    }

    public static function getInformationsForumCommentaire()
    {
        $forumCommentaireModel = new ForumCommentaireModel();
        $connectionPDO = new ConnectionPDO();

        $forumCommentaireModel->select(["mnga_forumcommentaire.id", "mnga_forumcommentaire.commentaire", "mnga_forum.title as forum_title", "mnga_user.firstname as user_firstname", "mnga_user.lastname as user_lastname"]);
        $forumCommentaireModel->leftJoin("mnga_forum", "mnga_forumcommentaire.id_forum", "mnga_forum.id");
        $forumCommentaireModel->leftJoin("mnga_user", "mnga_forumcommentaire.id_user", "mnga_user.id");
        $forumCommentaireModel->where("isValid", "=0");
        $req = $connectionPDO->pdo->prepare($forumCommentaireModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

}
