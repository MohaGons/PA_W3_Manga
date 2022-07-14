<?php

namespace App\Repository;

use App\Model\Category as CategoryModel;
use App\Core\ConnectionPDO;

class Category {

    public static function all()
    {
        $mangaModel = new CategoryModel();
        $connectionPDO = new ConnectionPDO();

        $mangaModel->select(["*"]);
        $req = $connectionPDO->pdo->prepare($mangaModel ->getQuery());
        $req->execute();

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function findById($id)
    {
        $mangaModel = new CategoryModel();
        $connectionPDO = new ConnectionPDO();

        $mangaModel->select(["*"]);
        $mangaModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($mangaModel->getQuery());
        $req->execute();

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }



}
