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

    public function getCommentaireForm($categorie_data): array
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
                    "type"=>"text",
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

}