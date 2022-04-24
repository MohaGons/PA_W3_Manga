<?php
namespace App\Model;

use App\Core\Sql;

class Category extends Sql
{
    protected $id = null;   
    protected $name = null;
    protected $description = null;

    public function __construct()
    {
        echo "constructeur du Model Category";
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId(): ?int
    {
        return $this->id;
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
                "name"=>[
                    "placeholder"=>"Nom",
                    "type"=>"text",
                    "id"=>"nameCategory",
                    "class"=>"formCategory",
                    "required"=>true,
                ],
                "description"=>[
                    "placeholder"=>"description",
                    "type"=>"text",
                    "id"=>"descriptionCategory",
                    "class"=>"formCategory",
                    "required"=>false,
                ]
            ]
        ];
    }

    public function editCategoryForm(): array
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
                "name"=>[
                    "placeholder"=>"Nom",
                    "type"=>"text",
                    "id"=>"editNameCategory",
                    "class"=>"editFormCategory",
                    "required"=>true,
                ],
                "description"=>[
                    "placeholder"=>"description",
                    "type"=>"text",
                    "id"=>"editDescriptionCategory",
                    "class"=>"editFormCategory",
                    "required"=>false,
                ]
            ]
        ];
    }
}