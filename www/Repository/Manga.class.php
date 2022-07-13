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

    public function delete($id) 
    {
        $mangaModel = new MangaModel();
        $connectionPDO = new ConnectionPDO();

        $mangaModel->delete();
        $mangaModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($mangaModel->getQuery());
        $req->execute();

        return header("Location: /admin/manga");
    }

}
