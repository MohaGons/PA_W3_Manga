<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use PDO;

class Role extends MysqlBuilder
{

    protected $id = null;
    protected $role = null;
    protected $createdAt = null;
    protected $updatedAt = null;

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

    /**
     * @return null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param null $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param null $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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
