<?php

namespace App\Repository;

use App\Model\Role as RoleModel;
use App\Core\ConnectionPDO;

class Role {

    public static function all()
    {
        $roleModel = new RoleModel();
        $connectionPDO = new ConnectionPDO();

        $roleModel->select(["*"]);
        $req = $connectionPDO->pdo->prepare($roleModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function findById($id)
    {
        $roleModel = new RoleModel();
        $connectionPDO = new ConnectionPDO();

        $roleModel->select(["*"]);
        $roleModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($roleModel->getQuery());
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

    public static function getRoleName($id)
    {
        $roleModel = new RoleModel();
        $connectionPDO = new ConnectionPDO();

        $roleModel->select(["role"]);
        $roleModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($roleModel->getQuery());
        $req->execute();

        $result = $req->fetch();

        return $result;
    }

}
