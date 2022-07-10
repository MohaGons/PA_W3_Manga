<?php

namespace App\Model;

use App\Core\MysqlBuilder;



class Event extends MysqlBuilder
{
    protected $id = null;
    protected $name = null;
    protected $description = null;
    protected $price = 0;
    protected $date = null;
    protected $photo = null;

    public function __construct()
    {

        parent::__construct();
    }


    public function save(): void
    {
        parent::save();
    }

    /**
     * @return null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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
        $this->name = $name;
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
        $this->description = $description;
    }

    /**
     * @return null
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param null $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
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
        $this->date = $date;
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
        $this->photo = $photo;
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
                    "placeholder" => "Nom...",
                    "type" => "text",
                    "id" => "eventRegister",
                    "class" => "formEvent",
                    "value"=>"",
                    "required" => true,
                    "error" => "Nom de l'évènement incorect",
                    "unicity" => true,
                    "errorUnicity" => "Un évènement existe déjà avec ce nom"
                ],
                "description" => [
                    "label" => "",
                    "type" => "textarea",
                    "id" => "descriptionRegister",
                    "class" => "FormEvent",
                    "required" => true,
                    "rows" => 5,
                    "cols" => 20,
                    "error" => "Mettre une description correct"
                ],
                "price" => [
                    "placeholder" => "....",
                    "type" => "number",
                    "id" => "priceRegister",
                    "class" => "formEvent",
                    "min" => 0,
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
                    //"required" => true,
                    "error" => "Mettre une photo correct",
                    "accept" => "image/*"
                ],
                "submit"=>[
                    "type"=>"submit",
                    "class"=>"button-submit",
                    "title"=>"Confirmer",
                ]
            ]
        ];
    }

    public function getEventEditFormRegister($event_data): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "formEvent",
                "class" => "formEvent",
                "submit" => "Modifier L'evenement"
            ],
            "inputs" => [
                "name" => [
                    "placeholder" => "test...",
                    "type" => "text",
                    "id" => "eventRegister",
                    "class" => "formEvent",
                    "value"=>"",
                    "required" => true,
                    "error" => "Nom de l'évènement incorect",
                    "value" => $event_data['name'],
                    "unicity" => true,
                    "errorUnicity" => "Un évènement existe déjà avec ce nom"

                ],
                "description" => [
                    "label" => "",
                    "placeholder" => "Description...",
                    "type" => "textarea",
                    "id" => "descriptionRegister",
                    "class" => "FormEvent",
                    "value" => $event_data['description'],
                    "required" => true,
                    "rows" => 5,
                    "cols" => 20,
                    "error" => "Mettre une description correct"
                ],
                "price" => [
                    "placeholder" => "....",
                    "type" => "number",
                    "id" => "priceRegister",
                    "class" => "formEvent",
                    "min" => 0,
                    "required" => true,
                    "value" => $event_data['price'],
                    "error" => "Mettre un prix correct",

                ],
                "date" => [
                    "placeholder" => "...",
                    "type" => "date",
                    "id" => "dateRegister",
                    "class" => "formEvent",
                    "required" => true,
                    "value" => $event_data['date'],
                    "error" => "Mettre une date correct",
                ],
                "photo" => [
                    "placeholder" => "....",
                    "label" => "Fichier de l'évènement ",
                    "type" => "file",
                    "id" => "photoRegister",
                    "class" => "formEvent",
                    "value" => $event_data['photo'],
                    //"required" => true,
                    "error" => "Mettre une photo correct",
                    "accept" => "image/*"
                ],
                "submit"=>[
                    "type"=>"submit",
                    "class"=>"button-submit",
                    "title"=>"Confirmer",
                ]
            ]
        ];
    }
}
