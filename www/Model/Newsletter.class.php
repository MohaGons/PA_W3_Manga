<?php
namespace App\Model;

use App\Core\Session as Session;
use App\Core\MysqlBuilder;

class Newsletter extends MysqlBuilder
{

    protected $id = null;
    protected $id_user = null;
    protected $id_subject = null;
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

    /**
     * @return null
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param null $id_user
     */
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return null
     */
    public function getIdSubject()
    {
        return $this->id_subject;
    }

    /**
     * @param null $id_subject
     */
    public function setIdSubject($id_subject): void
    {
        $this->id_subject = $id_subject;
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


    public function getNewsletterForm(): array
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
                "manga"=>[
                    "type"=>"radio",
                    "required"=>true,
                    "label"=>"Manga : ",
                    "option"=> [
                        [
                            "value"=>"yes",
                            "label"=>"Yes : ",
                            "id"=>"yes",
                            "class"=>"formRegister",
                        ],
                        [
                            "value"=>"no",
                            "label"=>"No : ",
                            "id"=>"no",
                            "class"=>"formRegister",
                        ]
                    ],
                    "defaultValue" =>  "no"
                ],
                "evenement"=>[
                    "type"=>"radio",
                    "required"=>true,
                    "label"=>"Evenement : ",
                    "option"=> [
                        [
                            "value"=>"yes",
                            "label"=>"Yes : ",
                            "id"=>"yes",
                            "class"=>"formRegister",
                        ],
                        [
                            "value"=>"no",
                            "label"=>"No : ",
                            "id"=>"no",
                            "class"=>"formRegister",
                        ]
                    ],
                    "defaultValue" =>  "no"
                ],

            ]
        ];
    }

}
