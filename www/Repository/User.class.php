<?php

namespace App\Repository;

use App\Core\Session as Session;
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

        $result = $req->fetch();

        return $result;
    }
    public static function findById($id)
    {
        $userModel = new UserModel();
        $connectionPDO = new ConnectionPDO();

        $userModel->select(["*"]);
        $userModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($userModel->getQuery());
        $req->execute();

        $result = $req->fetch();

        return $result;
    }

    public static function checkLogin($data) {
        $userModel = new UserModel();
        $connectionPDO = new ConnectionPDO();

        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);
        $column["email"] = $email;

        $userModel->select(["id", "email", "password", "role"]);
        $userModel->where("email", $email, "=");
        $req = $connectionPDO->pdo->prepare($userModel->getQuery());
        $req->execute($column);

        $result = $req->fetch();

        if (password_verify($password, $result['password'])) {
            Session::set('email', $result['email']);
            Session::set('id', $result['id']);
            $role = Role::getRoleName($result['role']);
            Session::set('role', $role["role"]);
            return true;
        } else {
            return false;
        }
    }


}
