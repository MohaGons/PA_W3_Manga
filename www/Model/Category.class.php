<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use App\Core\Session as Session;

class Category extends MysqlBuilder
{

    protected $id = null;   
    protected $name = null;
    protected $description = null;
    protected $createdAt = null;
    protected $updatedAt = null;
    protected $user_id = null;

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

    public function getNameCategory(): ?string
    {
        return $this->name;
    }

    public function setNameCategory(?string $name): void
    {
        $this->name = ucwords(strtolower(trim($name)));
    }

    public function getDescriptionCategory(): ?string
    {
        return $this->description;
    }

    public function setDescriptionCategory(?string $description): void
    {
        $this->description = ucwords(strtolower(trim($description)));
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

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getCategoryForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formCategory",
                "class"=>"formCategory",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "token"=> [
                    "type"=> "hidden",
                    "value"=> Session::get('token'),
                ],
                "name"=>[
                    "label"=>"Nom: ",
                    "placeholder"=>"Nom",
                    "type"=>"text",
                    "id"=>"nameCategory",
                    "class"=>"formCategory",
                    "value"=>"",
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Veuillez mettre au moins mettre le nom (faire entre 2 et 25 caractères)",
                    
                ],
                "description"=>[
                    "label"=>"Description: ",
                    "placeholder"=>"description (facultatif)",
                    "type"=>"text",
                    "id"=>"descriptionCategory",
                    "class"=>"formCategory",
                    "value"=>"",
                    "minlength"=>'',
                    "maxlength"=>'',
                    "required"=>false,
                ]
            ]
        ];
    }

    public function editCategoryForm($categorie_data): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"editFormCategory",
                "class"=>"editFormCategory",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "token"=> [
                    "type"=> "hidden",
                    "value"=> Session::get('token'),
                ],
                "editName"=>[
                    "label"=>"Nom: ",
                    "placeholder"=>"Nom",
                    "type"=>"text",
                    "id"=>"editNameCategory",
                    "class"=>"editFormCategory",
                    "value"=>$categorie_data[0]['name'],
                    "minlength"=>2,
                    "maxlength"=>25,
                    "required"=>true,
                ],
                "editDescription"=>[
                    "label"=>"Description: ",
                    "placeholder"=>"description",
                    "type"=>"text",
                    "id"=>"editDescriptionCategory",
                    "class"=>"editFormCategory",
                    "value"=>$categorie_data[0]['description'],
                    "minlength"=>'',
                    "maxlength"=>'',
                    "required"=>false,

                ]
            ]
        ];
    }

}
