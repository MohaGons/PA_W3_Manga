<?php
namespace App\Model;

use App\Core\Sql;
use PDO;
session_start();
class User extends Sql
{
    protected $id = null;
    protected $firstname = null;
    protected $lastname = null;
    protected $email;
    protected $status = 0;
    protected $password;
    protected $token = null;

    public function __construct()
    {

        parent::__construct();
    }


    function checkLogin()
    {

        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $q = "SELECT ID FROM mnga_user WHERE email = ? AND password = ?";

        $req = $this->pdo->prepare($q);
        $req->execute( [$email, $password] );
        $results = $req->fetchAll();
        return $results;
    }

    function passwordReset()
    {
        if (isset($_POST['pwdReset'])){
            $email = strtolower(trim($email)); // On récupère le mail afin d envoyer le mail pour la récupèration du mot de passe

            // Si le mail est vide alors on le traite pas
            if(empty($email)){
                $valid = false;
                echo "Tapez votre Email";
            }

            if($valid){
                $verification_mail = $this->pdo->query("SELECT nom, prenom, mail, n_mdp FROM utilisateur WHERE mail = ?", array($mail));
                $verification_mail = $verification_mail->fetch();

                if(isset($verification_mail['mail'])){
                    if($verification_mail['n_mdp'] == 0){
                        // On génère un mot de passe à l'aide de la fonction RAND de PHP
                        $new_pass = rand();
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
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param null
     */
    public function generateToken(): void
    {
        $bytes = random_bytes(128);
        $this->token = substr(str_shuffle(bin2hex($bytes)), 0, 255);
    }


    public function save(): void
    {
        //Pré traitement par exemple
        //echo "pre traitement";
        parent::save();
    }

    public function getRegisterForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formRegister",
                "class"=>"formRegister",
                "submit"=>"S'inscrire"
            ],
            "inputs"=>[
                "email"=>[
                    "placeholder"=>"Votre email ...",
                    "type"=>"email",
                    "id"=>"emailRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Email incorrect",
                    "unicity"=>true,
                    "errorUnicity"=>"Un compte existe déjà avec cet email"
                ],
                "password"=>[
                    "placeholder"=>"Votre mot de passe ...",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire au min 8 caratères avec une majuscule et un chiffre"
                ],
                "passwordConfirm"=>[
                    "placeholder"=>"Confirmation ...",
                    "type"=>"password",
                    "id"=>"pwdConfirmRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Votre confirmation de mot de passe ne correspond pas",
                    "confirm"=>"password"
                ],
                "firstname"=>[
                    "placeholder"=>"Votre prénom ...",
                    "type"=>"text",
                    "id"=>"firstnameRegister",
                    "class"=>"formRegister",
                    "min"=>2,
                    "max"=>25,
                    "error"=>" Votre prénom doit faire entre 2 et 25 caractères",
                ],
                "lastname"=>[
                    "placeholder"=>"Votre nom ...",
                    "type"=>"text",
                    "id"=>"lastnameRegister",
                    "class"=>"formRegister",
                    "min"=>2,
                    "max"=>100,
                    "error"=>" Votre nom doit faire entre 2 et 100 caractères",
                ],
                "nationality"=>[
                    "placeholder"=>"Votre nationalite ...",
                    "type"=>"select",
                    "id"=>"nationalityRegister",
                    "class"=>"formRegister",
                    "option"=> [
                        "fr" => "French",
                        "en" => "English",
                        "es" => "Espagnol"
                    ],
                    "defaultValue" =>  "en"

                ],
                "gender"=>[
                    "type"=>"radio",
                    "option"=> [
                        [
                            "value"=>"M",
                            "label"=>"Masculin",
                            "id"=>"male",
                            "class"=>"formRegister",
                        ],
                        [
                            "value"=>"F",
                            "label"=>"Féminin",
                            "id"=>"feminin",
                            "class"=>"formRegister",
                        ]
                    ],
                    "defaultValue" =>  "feminin"
                ],
                "cgu"=>[
                    "type"=>"checkbox",
                    "option"=> [
                        [
                            "value"=>"cgu1",
                            "label"=>"CGU 1",
                            "id"=>"cgu1",
                            "class"=>"formRegister",
                        ],
                        [
                            "value"=>"cgu2",
                            "label"=>"CGU 2",
                            "id"=>"cgu2",
                            "class"=>"formRegister",
                        ],
                        [
                            "value"=>"cgu3",
                            "label"=>"CGU 3",
                            "id"=>"cgu3",
                            "class"=>"formRegister",
                        ]
                    ],
                    "defaultValue" =>  "cgu2"
                ],
                "description"=> [
                    "type"=> "textarea",
                    "label"=> "Description : ",
                    "id"=>"description",
                    "class"=>"formRegister",
                    'rows'=> 8,
                    'cols'=> 33,
                    'text'=>"Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500"
                ],
                "avatar"=> [
                    "type"=> "file",
                    "label"=> "Avatar : ",
                    "id"=>"avatar",
                    "class"=>"formRegister",
                    "accept" => "image/*"
                ]

            ]
        ];
    }

    public function getLoginForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formLogin",
                "class"=>"formLogin",
                "submit"=>"Se connecter"
            ],
            "inputs"=>[
                "email"=>[
                    "placeholder"=>"Votre email ...",
                    "type"=>"email",
                    "id"=>"emailRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                ],
                "password"=>[
                    "placeholder"=>"Votre mot de passe ...",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                ]
            ]
        ];
    }

}