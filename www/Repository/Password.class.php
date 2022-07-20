<?php

namespace App\Repository;

use App\Core\Session as Session;
use App\Model\Password as PasswordModel;
use App\Core\ConnectionPDO;

class Password {

    public static function findByEmailAndToken($email, $token)
    {
        $passwordModel = new PasswordModel();
        $connectionPDO = new ConnectionPDO();

        $passwordModel->select(["*"]);
        $passwordModel->where("email", $email, "=");
        $passwordModel->where("token", $token, "=");
        $req = $connectionPDO->pdo->prepare($passwordModel->getQuery());

        $req->execute();

        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }


}
