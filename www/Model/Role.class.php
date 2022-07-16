<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use PDO;

class Role extends MysqlBuilder
{

    protected $id = null;
    protected $role = null;

    public function __construct()
    {

        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function getRolee($id)
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
