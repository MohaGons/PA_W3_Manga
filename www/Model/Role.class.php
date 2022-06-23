<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use PDO;

class Role extends MysqlBuilder
{

    public function getRole($id)
    {
        $q = "SELECT role FROM roles WHERE id_role = :id";
        $req = $this->pdo->prepare($q);
        $req->execute(['id' => $id]);
        return $req->fetch();
    }

    public function  getAllRoles()
    {
        $q = "SELECT * FROM roles";
        $req = $this->pdo->prepare($q);
        $req->execute();
        $res = $req->fetchAll();
        $roles = [];
        $count = 0;
        foreach ($res as $r){
            $roles[$r["id"]] = $r["role"];
            $count++;
        }
        return $roles;
    }
}