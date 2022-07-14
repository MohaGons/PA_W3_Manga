<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use App\Core\Sql;

class ForumCommentaire extends MysqlBuilder
{

    protected $id = null;
    protected $id_forum = null;
    protected $id_user = null;
    protected $commentaire = null;
    protected $date_creation = null;
    protected $isValid = 0;

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

    public function getForumId(): ?int
    {
        return $this->id_forum;
    }

    public function setForumId($id_forum){
        $this->id_forum = $id_forum;
    }

    public function getUserId(): ?int
    {
        return $this->id_user;
    }

    public function setUserId($id_user){
        $this->id_user = $id_user;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): void
    {
        $this->commentaire = ucwords(strtolower(trim($commentaire)));
    }

    public function getDateCreation(): ?string
    {
        return $this->date_creation;
    }

    public function setDateCreation(?string $date_creation): void
    {
        $this->date_creation = ucwords(strtolower(trim($date_creation)));
    }

    public function getIsValid(): ?int
    {
        return $this->isValid;
    }

    public function setIsValid(?int $isValid): void
    {
        $this->isValid = $isValid;
    }

    public function getCommentaireForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"commentaireForum",
                "class"=>"formForum",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "commentaire"=>[
                    "placeholder"=>"Commentaire",
                    "type"=>"textarea",
                    "id"=>"commentaire",
                    "class"=>"formForum",
                    "value"=>"",
                    "required"=>true,
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Votre titre doit faire entre 2 et 100 caractères",
                ],
            ]
        ];
    }

    public function getAllCommentairesNoValid() {
        $query = $this->pdo->prepare("SELECT * FROM mnga_forum_commentaire WHERE isValid= 0");
        $query->execute();
        $forum_commentaire_data = $query->fetchAll();
        return $forum_commentaire_data;
    }

    public function validCommentaire($id) {
        $query = $this->pdo->prepare("UPDATE mnga_forum_commentaire SET isValid=1 WHERE id=?");
        $query->execute([$id]);
        $forum_commentaire_data = $query->fetchAll();
        return $forum_commentaire_data;
    }

    public function deleteCommentaire($id) {
        $query = $this->pdo->prepare("DELETE FROM mnga_forum_commentaire WHERE id=?");
        $query->execute([$id]);
    }

}