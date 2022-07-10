<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use App\Core\Sql;

class CommentaireForum extends MysqlBuilder
{

    protected $id = null;
    protected $forum_id = null;
    protected $user_id = null;
    protected $commentaire = null;
    protected $date_creation = null;

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
        return $this->forum_id;
    }

    public function setForumId($forum_id){
        $this->forum_id = $forum_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getCommentaire(): ?string
    {
        return $this->desccommentaireription;
    }

    public function setCommentaire(?string $commentaire): void
    {
        $this->commentaire = ucwords(strtolower(trim($commentaire)));
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