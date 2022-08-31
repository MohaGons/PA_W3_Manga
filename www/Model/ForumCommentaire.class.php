<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use App\Core\Sql;
use App\Core\Session as Session;

class ForumCommentaire extends MysqlBuilder
{

    protected $id = null;
    protected $id_forum = null;
    protected $id_user = null;
    protected $commentaire = null;
    protected $isValid = 0;
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
        $this->commentaire = $commentaire;
    }

    public function getIsValid(): ?int
    {
        return $this->isValid;
    }

    public function setIsValid(?int $isValid): void
    {
        $this->isValid = $isValid;
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

    public function getCreateCommentaireForm(): array
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
                "token"=> [
                    "type"=> "hidden",
                    "value"=> Session::get('token'),
                ],
                "commentaire"=>[
                    "label"=> "Commentaire: ",
                    "type"=>"textarea",
                    "id"=>"commentaire",
                    "class"=>"formForum",
                    "rows"=>"5",
                    "cols"=>"33",
                    "text"=>"",
                    "required"=>true,
                    "error"=>"Votre description doit faire entre 2 et 100 caractères",
                ],
            ]
        ];
    }

}
