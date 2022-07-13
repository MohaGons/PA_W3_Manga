<?php

namespace App\Repository;

use App\Model\Forum as ForumModel;
use App\Core\ConnectionPDO;

class Forum {

    public function all()
    {
        $forumModel = new ForumModel();
        $connectionPDO = new ConnectionPDO();

        $forumModel->select(["*"]);
        $req = $connectionPDO->pdo->prepare($forumModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function findById($id)
    {
        $forumModel = new ForumModel();
        $connectionPDO = new ConnectionPDO();

        $forumModel->select(["*"]);
        $forumModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($forumModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public function deleteForum($forum_Id)
    {
        $query = $this->pdo->prepare("DELETE FROM mnga_forum WHERE id= :id");
        $query->bindValue(':id', $forum_Id);
        $query->execute();
    }

}
