<?php

namespace App\Repository;

use App\Model\User as UserModel;
use App\Core\ConnectionPDO;

class User {

    public static function all()
    {
        $userModel = new UserModel();
        $connectionPDO = new ConnectionPDO();

        $userModel->select(["*"]);
        $req = $connectionPDO->pdo->prepare($userModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function findByEmail($email)
    {
        $userModel = new UserModel();
        $connectionPDO = new ConnectionPDO();

        $userModel->select(["id"]);
        $userModel->where("email", $email, "=");
        $req = $connectionPDO->pdo->prepare($userModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function checkLogin($data) {
        $userModel = new UserModel();
        $connectionPDO = new ConnectionPDO();

        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);

        $userModel->select(["id", "email", "password"]);
        $userModel->where("email", $email, "=");
        $req = $connectionPDO->pdo->prepare($userModel->getQuery());
        $req->execute();

    }

}
