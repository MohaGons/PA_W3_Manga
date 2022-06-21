<?php
namespace App\Model;

use App\Core\Sql;

class Forum extends Sql
{
    protected $id = null;   
    protected $title = null;
    protected $description = null;
    protected $picture = null;
    protected $user_id = null;

    public function __construct()
    {
        echo "constructeur du Model Forum";
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

    public function getPictureForum(): ?string
    {
        return $this->picture;
    }

    public function setPictureForum(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getForumForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formForum",
                "enctype"=>"multipart/form-data",
                "class"=>"formForum",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "title"=>[
                    "placeholder"=>"Titre",
                    "type"=>"text",
                    "id"=>"nameForum",
                    "class"=>"formForum",
                    "required"=>true,
                ],
                "description"=>[
                    "placeholder"=>"Description",
                    "type"=>"text",
                    "id"=>"descriptionForum",
                    "class"=>"formForum",
                    "required"=>false,
                ],
                "picture"=> [
                    "type"=> "file",
                    "label"=> "Image: ",
                    "id"=>"picture",
                    "class"=>"formForum",
                    "accept" => "image/*"
                ]
            ]
        ];
    }
}