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
        $req = $connectionPDO->pdo->prepare($forumCommentaireModel ->getQuery());
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

    public function delete($id) 
    {
        $forumCommentaireModel = new ForumCommentaireModel();
        $connectionPDO = new ConnectionPDO();

        $forumCommentaireModel->delete();
        $forumCommentaireModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($forumCommentaireModel->getQuery());
        $req->execute();

        return header("Location: /admin/forumcommentaire");
    }

}
