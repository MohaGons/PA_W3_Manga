<?php
namespace App\Model;

use App\Core\Session as Session;
use App\Core\MysqlBuilder;

class Forum extends MysqlBuilder
{

    protected $id = null;   
    protected $title = null;
    protected $description = null;
    protected $picture = null;
    protected $date = null;
    protected $category_id = null;
    protected $user_id = null;
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

    public function getTitleForum(): ?string
    {
        return $this->title;
    }

    public function setTitleForum(?string $title): void
    {
        $this->title = ucwords(strtolower(trim($title)));
    }

    public function getDescriptionForum(): ?string
    {
        return $this->description;
    }

    public function setDescriptionForum(?string $description): void
    {
        $this->description = ucwords(strtolower(trim($description)));
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }
    
    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id){
        $this->category_id = $category_id;
    }


    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture($picture){
        $this->picture = $picture;
    }


    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
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

    public function getForumForm($categorie_data): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formForum",
                "class"=>"formForum",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "token"=> [
                    "type"=> "hidden",
                    "value"=> Session::get('token'),
                ],
                "title"=>[
                    "placeholder"=>"Titre",
                    "type"=>"text",
                    "label"=>"Titre: ",
                    "id"=>"nameForum",
                    "class"=>"formForum",
                    "value"=>"",
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "description"=>[
                    "label"=> "Description: ",
                    "type"=>"textarea",
                    "id"=>"descriptionForum",
                    "class"=>"formForum",
                    "rows"=>"5",
                    "cols"=>"33",
                    "text"=>"",
                    "required"=>true,
                    "error"=>"Votre description doit faire entre 2 et 2000 caractères",
                ],
                "categories"=> [
                    "label"=> "Catégorie: ",
                    "type"=> "select",
                    "id"=>"picture",
                    "option"=>$categorie_data,
                    "defaultValue"=>"",
                ]
            ]
        ];
    }

    public function editParamForum($forum_data, $categorie_data): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formForum",
                "class"=>"formForum",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "editTitle"=>[
                    "placeholder"=>"Titre",
                    "type"=>"text",
                    "label"=>"Titre: ",
                    "id"=>"nameForum",
                    "class"=>"formForum",
                    "value"=>$forum_data[0]['title'],
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "editDescription"=>[
                    "label"=>"Description: ",
                    "type"=>"textarea",
                    "id"=>"editDescriptionForum",
                    "class"=>"formForum",
                    "rows"=>"5",
                    "cols"=>"33",
                    "text"=>$forum_data[0]['description'],
                    "required"=>true,
                    "error"=>"Votre description doit faire entre 2 et 2000 caractères",
                ],
                "categories"=> [
                    "label"=> "Catégorie: ",
                    "type"=> "select",
                    "id"=>"picture",
                    "option"=>$categorie_data,
                    "defaultValue"=>$forum_data[0]['category_id'],
                ]
            ]
        ];
    }

}
