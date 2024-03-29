<?php

namespace App\Repository;

use App\Model\Forum as ForumModel;
use App\Core\ConnectionPDO;

class Forum {

    public static function all()
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

    public static function delete($id)
    {
        $forumModel = new ForumModel();
        $connectionPDO = new ConnectionPDO();

        $forumModel->delete();
        $forumModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($forumModel->getQuery());
        $req->execute();

        return header("Location: /admin/forum");
    }

    public static function getCategoryForum()
    {
        $forumModel = new ForumModel();
        $connectionPDO = new ConnectionPDO();

        $forumModel->select(["mnga_forum.id", "mnga_forum.title", "mnga_forum.description", "mnga_forum.picture", "mnga_forum.date", "mnga_category.name as category_name", "mnga_user.firstname as user_firstname", "mnga_user.lastname as user_lastname"]);
        $forumModel->leftJoin("mnga_category", "mnga_forum.category_id", "mnga_category.id");
        $forumModel->leftJoin("mnga_user", "mnga_forum.user_id", "mnga_user.id");
        $req = $connectionPDO->pdo->prepare($forumModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function getRecentCategoryForum()
    {
        $forumModel = new ForumModel();
        $connectionPDO = new ConnectionPDO();

        $forumModel->select(["mnga_forum.id", "mnga_forum.title", "mnga_forum.description", "mnga_forum.date", "mnga_category.name as category_name"]);
        $forumModel->leftJoin("mnga_category", "mnga_forum.category_id", "mnga_category.id");
        $forumModel->orderBy("mnga_forum.id", "DESC");
        $forumModel->limit(0,3);
        $req = $connectionPDO->pdo->prepare($forumModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

}
