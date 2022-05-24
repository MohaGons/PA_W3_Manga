<?php
namespace App\Model;

use App\Core\Sql;
use PDO;

class User extends Sql
{
    protected $id = null;
    protected $firstname = null;
    protected $lastname = null;
    protected $email;
    protected $status = 0;
    protected $password;
    protected $token = null;
    protected $avatar = null;
    protected $gender = null;
    protected $role = 1;

    public function __construct()
    {

        parent::__construct();
    }


    public function checkLogin($data)
    {

        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);
        $q = "SELECT ID, email, password FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        $results = $req->fetch();
        if (password_verify($password, $results['password'])) {
            return true;
        } else {
            return false;
        }

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
    public function getFirstname($email): ?string
    {
        $q = "SELECT firstname FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        $firstname = $req->fetch();
        return $firstname['firstname'];
    }

    /**
     * @param null $firstname
     */
    public function setFirstname(?string $firstname,$email): void
    {
        $firstname = ucwords(strtolower(trim($firstname)));
        $q = "UPDATE mnga_user SET firstname=? WHERE email=?";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([$firstname,$email]);

    }

    /**
     * @return null
     */
    public function getLastname($email): ?string
    {
        $q = "SELECT lastname FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        $lastname = $req->fetch();
        return $lastname['lastname'];
    }

    /**
     * @param null $lastname
     */
    public function setLastname(?string $lastname,$email): void
    {
        $lastname = strtoupper(trim($lastname));
        $q = "UPDATE mnga_user SET lastname=? WHERE email=?";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([$lastname,$email]);
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
    public function setPassword($password, $email): void
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $q = "UPDATE mnga_user SET password=? WHERE email=?";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([$password,$email]);
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

    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $status
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    public function getAvatar($email): string
    {
        $q = "SELECT avatar FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        $avatar = $req->fetch();
        return $avatar['avatar'];
    }

    /**
     * @param mixed $email
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = strtolower(trim($avatar));
    }

    public function getGender($email): string
    {
        $q = "SELECT gender FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        $gender = $req->fetch();
        return $gender['gender'];
    }

    /**
     * @param mixed $email
     */
    public function setGender(string $gender): void
    {
        $this->gender = strtolower(trim($gender));
    }

   public function deletecompte($email)
   {
       $q = "DELETE FROM mnga_user WHERE email = :email";
       $req = $this->pdo->prepare($q);
       if($req->execute(['email' => $email])){
         return 1;
       }
       else{
           return 0;
       }
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
                    "required"=>true,
                    "error"=>" Votre prénom doit faire entre 2 et 25 caractères",
                ],
                "lastname"=>[
                    "placeholder"=>"Votre nom ...",
                    "type"=>"text",
                    "id"=>"lastnameRegister",
                    "class"=>"formRegister",
                    "min"=>2,
                    "max"=>100,
                    "required"=>true,
                    "error"=>" Votre nom doit faire entre 2 et 100 caractères",
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
                /*
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
                */
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

    public function getParamForm($data): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formLogin",
                "class"=>"formLogin",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "firstname"=>[
                    "placeholder"=>$data['firstname'],
                    "type"=>"text",
                    "id"=>"emailRegister",
                    "class"=>"input",
                    "required"=>false,
                    "min"=>2,
                    "max"=>25,
                    "error"=>" Votre prénom doit faire entre 2 et 25 caractères",
                ],
                "lastname"=>[
                    "placeholder"=>$data['lastname'],
                    "type"=>"text",
                    "id"=>"pwdRegister",
                    "class"=>"input",
                    "required"=>false,
                    "min"=>2,
                    "max"=>100,
                    "error"=>" Votre nom doit faire entre 2 et 100 caractères",
                ],
                "password"=>[
                    "placeholder"=>"Nouveau mot de passe ...",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "class"=>"input",
                    "required"=>false,
                ],
                /*"avatar"=> [
                    "type"=> "file",
                    "label"=> "Avatar : ".$data['avatar'],
                    "id"=>"avatar",
                    "class"=>"input",
                    "accept" => "image/*"
                ]*/

            ]
        ];
    }
}