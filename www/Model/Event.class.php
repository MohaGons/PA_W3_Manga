<?php

namespace App\Model;

use App\Core\Sql;
use PDO;

class Event extends Sql
{
    protected $id = null;
    protected $name = null;
    protected $description = null;
    protected $price = null;
    protected $date = null;
    protected $photo = null;

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


    /**
     * @return null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName(?string $name): void
    {
        $this->name;
    }

    /**
     * @return null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description;
    }

    /**
     * @return null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param null $price
     */
    public function setPrice(?string $price): void
    {
        $this->price;
    }

    /**
     * @return null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param null $price
     */
    public function setDate(?string $date): void
    {
        $this->date;
    }


    /**
     * @return null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param null $price
     */
    public function setPhoto(?string $photo): void
    {
        $this->photo;
    }




    public function getEventFormRegister(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "formEvent",
                "class" => "formEvent",
                "submit" => "Créer un nouvel évènement"
            ],
            "inputs" => [
                "name" => [
                    "placeholder" => "Nom de l'évènement",
                    "type" => "text",
                    "id" => "eventRegister",
                    "class" => "formEvent",
                    "required" => true,
                    "error" => "Nom de l'évènement incorect",
                    "unicity" => true,
                    "errorUnicity" => "Un évènement existe déjà avec ce nom"
                ],
                "description" => [
                    "placeholder" => "Description de l'évènement",
                    "type" => "text",
                    "id" => "descriptionRegister",
                    "class" => "FormEvent",
                    "required" => true,
                    "error" => "Mettre une description correct"
                ],
                "price" => [
                    "placeholder" => "....",
                    "type" => "number",
                    "id" => "priceRegister",
                    "class" => "formEvent",
                    "required" => true,
                    "error" => "Mettre un prix correct",

                ],
                "date" => [
                    "placeholder" => "...",
                    "type" => "date",
                    "id" => "dateRegister",
                    "class" => "formEvent",
                    "required" => true,
                    "error" => "Mettre une date correct",
                ],
                "photo" => [
                    "placeholder" => "....",
                    "label" => "Fichier de l'évènement ",
                    "type" => "file",
                    "id" => "photoRegister",
                    "class" => "formEvent",
                    "required" => true,
                    "error" => "Mettre une photo correct",
                    "accept" => "image/*"
                ]
            ]
        ];
    }
}
