<?php

namespace App\Repository;

use App\Model\Manga as MangaModel;
use App\Core\ConnectionPDO;

class Manga {

    public static function all()
    {
        $mangaModel = new MangaModel();
        $connectionPDO = new ConnectionPDO();

        $mangaModel->select(["*"]);
        $req = $connectionPDO->pdo->prepare($mangaModel ->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function findById($id)
    {
        $mangaModel = new MangaModel();
        $connectionPDO = new ConnectionPDO();

        $mangaModel->select(["*"]);
        $mangaModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($mangaModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function findByEmail($email)
    {
        $roleModel = new RoleModel();
        $connectionPDO = new ConnectionPDO();

        $roleModel->select(["id"]);
        $roleModel->where("email", $email, "=");
        $req = $connectionPDO->pdo->prepare($roleModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }


}
