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

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

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

        $result = $req->fetch(\PDO::FETCH_ASSOC);

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

        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function checkLogin($data) {
        $userModel = new UserModel();
        $connectionPDO = new ConnectionPDO();

        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);
        $column["email"] = $email;

        $userModel->select(["id", "email", "password", "role", "token"]);
        $userModel->where("email", $email, "=");
        $req = $connectionPDO->pdo->prepare($userModel->getQuery());
        $req->execute($column);

        $result = $req->fetch(\PDO::FETCH_ASSOC);

        if (password_verify($password, $result['password'])) {

            $token = substr(str_shuffle(bin2hex(random_bytes(128)  )), 0, 255);

            $persist = self::updateToken($token,$result['id']);

//            die(var_dump($persist));

            if ($persist == true) {
                Session::set('email', $result['email']);
                Session::set('id', $result['id']);
                Session::set('token', $token);
                $role = Role::getRoleName($result['role']);
                Session::set('role', $role["role"]);

                return true;
            }
            else {
                die("error generate token");
            }




        } else {
            return false;
        }
    }

    public static function updateToken($token, $id)
    {
        $userModel = new UserModel();
        $connectionPDO = new ConnectionPDO();
        $colums = ["token"=> "token"];
        $update = [];
        foreach ($colums as $key => $value) {
            $update[] = $key . "=:" . $key;
        }
        $userModel->update($update);
        $req = $connectionPDO->pdo->prepare($userModel->getQuery());

        if ($req->execute(["token"=>$token, "id"=>$id])) {
            return true;
        }
        else {
            return false;
        }

    }


}
