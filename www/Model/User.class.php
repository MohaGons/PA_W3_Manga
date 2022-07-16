<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use App\Repository\Role as RoleRepository;
use App\Model\Role as RoleModel;
use App\Core\Session as Session;
use PDO;

class User extends MysqlBuilder
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
    protected $pays = null;
    protected $ville = null;
    protected $createdAt = null;
    protected $updatedAt = null;

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
     * @param null id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @param null $firstname
     */
    public function updateFirstname(?string $firstname,$email): void
    {
        $firstname = ucwords(strtolower(trim($firstname)));
        $q = "UPDATE mnga_user SET firstname=? WHERE email=?";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([$firstname,$email]);

    }

    /**
     * @param null $firstname
     */
    public function updateFirstnameId(?string $firstname,$id): void
    {
        $firstname = ucwords(strtolower(trim($firstname)));
        $q = "UPDATE mnga_user SET firstname=? WHERE ID=?";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([$firstname,$id]);

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
    public function setLastname(?string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @param null $lastname
     */
    public function updateLastname(?string $lastname,$email): void
    {
        $lastname = strtoupper(trim($lastname));
        $q = "UPDATE mnga_user SET lastname=? WHERE email=?";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([$lastname,$email]);
    }

    /**
     * @param null $lastname
     */
    public function updateLastnameId(?string $lastname,$id): void
    {
        $lastname = strtoupper(trim($lastname));
        $q = "UPDATE mnga_user SET lastname=? WHERE ID=?";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([$lastname,$id]);
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

    public function updateEmailId(string $email, $id): void
    {
        $email = strtoupper(trim($email));
        $q = "UPDATE mnga_user SET email=? WHERE ID=?";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([$email,$id]);
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
    public function generateToken($token): void
    {
        $this->token = $token;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getRoleByEmail($email)
    {
        $q = "SELECT role FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        return $req->fetch();
    }

    public function updateRole($email, $id)
    {
        $q = "UPDATE mnga_user SET role=? WHERE id=?";
        $req = $this->pdo->prepare($q);
        $req->execute([$email,$id]);
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

    /**
     * @param mixed $email
     */
    public function updateAvatar(string $avatar): void
    {

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

    public function getVille($ville): string
    {
        return $this->ville;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
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

    public function deleteuser($id)
    {
        $q = "DELETE FROM mnga_user WHERE id = :id";
        $req = $this->pdo->prepare($q);
        if($req->execute(['id' => $id])){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function NombreUsers(){
        $q = "SELECT * FROM mnga_user";
        $req = $this->pdo->prepare($q);
        $req ->execute();
        $resultat = $req->fetchAll();
        return $resultat;
    }
   public function getAllUsers($deb,$fin){
       $q = "SELECT * FROM mnga_user LIMIT :deb, :fin";
       $req = $this->pdo->prepare($q);
       $req->bindValue(':deb', $deb, PDO::PARAM_INT);
       $req->bindValue(':fin', $fin, PDO::PARAM_INT);
       $req ->execute();
       $resultat = $req->fetchAll();
       return $resultat;
   }

    public function getAllUsersByDate(){
        $q = "SELECT * FROM mnga_user ORDER BY createdAt DESC";
        $req = $this->pdo->prepare($q);
        $req ->execute();
        $resultat = $req->fetchAll();
        return $resultat;
    }

    public function getAllUsersByName(){
        $q = "SELECT * FROM mnga_user ORDER BY lastname";
        $req = $this->pdo->prepare($q);
        $req ->execute();
        $resultat = $req->fetchAll();
        return $resultat;
    }

    public function searchUser($search){
        $search = "%$search%";
        $q = "SELECT * FROM mnga_user WHERE lastname LIKE :search OR firstname LIKE :search ";
        $req = $this->pdo->prepare($q);
        $req->bindValue('search', $search);
        $req->execute();
        $resultat = $req->fetchAll();
        return $resultat;
    }

    public function setPays($type){
        $ip_visiteur = 'X.X.X.X';
        $ipinfo = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip_visiteur));
        $Pays = $ipinfo->geoplugin_countryName;
        $Ville = $ipinfo->geoplugin_city;
        $Continent = $ipinfo->geoplugin_continentName;
        if ($type=="Pays"){
            $this->pays=$Pays;
        }
        if ($type=="Ville"){
            $this->ville=$Ville;
        }
        if ($type=="Continent"){
            $this->continent=$Continent;
        }
        else{
            return NULL;
        }
    }

    public function getBestPays(){
        $q = "SELECT pays, COUNT(*) FROM mnga_user GROUP BY pays ORDER BY COUNT(*) DESC LIMIT 5";
        $req = $this->pdo->prepare($q);
        $req->execute();
        $resultat = $req->fetchAll();
        return $resultat;
    }


    public function getRegisterForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formRegister",
                "enctype"=>"multipart/form-data",
                "class"=>"formRegister",
                "submit"=>"S'inscrire"
            ],
            "inputs"=>[
                "email"=>[
                    "placeholder"=>"Votre email ...",
                    "type"=>"email",
                    "id"=>"emailRegister",
                    "class"=>"formRegister",
                    "label"=>"Email : ",
                    "required"=>true,
                    "error"=>"Email incorrect",
                ],
                "password"=>[
                    "placeholder"=>"Votre mot de passe ...",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "class"=>"formRegister",
                    "label"=>"Password : ",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire au min 8 caratères avec une majuscule et un chiffre"
                ],
                "passwordConfirm"=>[
                    "placeholder"=>"Confirmation ...",
                    "type"=>"password",
                    "id"=>"pwdConfirmRegister",
                    "class"=>"formRegister",
                    "label"=>"Password confirm : ",
                    "required"=>true,
                    "error"=>"Votre confirmation de mot de passe ne correspond pas",
                    "confirm"=>"password"
                ],
                "firstname"=>[
                    "placeholder"=>"Votre prénom ...",
                    "type"=>"text",
                    "id"=>"firstnameRegister",
                    "class"=>"formRegister",
                    "value"=>"",
                    "label"=>"Firstname : ",
                    "minlength"=>2,
                    "maxlength"=>25,
                    "required"=>true,
                    "error"=>" Votre prénom doit faire entre 2 et 25 caractères",
                ],
                "lastname"=>[
                    "placeholder"=>"Votre nom ...",
                    "type"=>"text",
                    "id"=>"lastnameRegister",
                    "class"=>"formRegister",
                    "value"=>"",
                    "label"=>"Lastname : ",
                    "minlength"=>2,
                    "maxlength"=>100,
                    "required"=>true,
                    "error"=>" Votre nom doit faire entre 2 et 100 caractères",
                ],
                "gender"=>[
                    "type"=>"radio",
                    "required"=>true,
                    "option"=> [
                        [
                            "value"=>"M",
                            "label"=>"Masculin : ",
                            "id"=>"male",
                            "class"=>"formRegister",
                        ],
                        [
                            "value"=>"F",
                            "label"=>"Féminin : ",
                            "id"=>"feminin",
                            "class"=>"formRegister",
                        ]
                    ],
                    "defaultValue" =>  "feminin"
                ],
                "file"=> [
                    "type"=> "file",
                    "label"=> "Avatar : ",
                    "id"=>"file",
                    "class"=>"formRegister",
                    "required"=>false,
                    "accept" => ""
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
                    "label"=>"Email : ",
                    "error"=>"Email incorrect",
                    "required"=>true,
                ],
                "password"=>[
                    "placeholder"=>"Votre mot de passe ...",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "class"=>"formRegister",
                    "label"=>"Password : ",
                    "required"=>true,
                ],
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
                    "placeholder"=>"Prénom",
                    "type"=>"text",
                    "id"=>"emailRegister",
                    "label"=>"",
                    "class"=>"formparam",
                    "value"=>$data['firstname'],
                    "required"=>false,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>" Votre prénom doit faire entre 2 et 25 caractères",
                ],
                "lastname"=>[
                    "placeholder"=>"Nom de famille",
                    "type"=>"text",
                    "id"=>"pwdRegister",
                    "class"=>"formparam",
                    "label"=>"",
                    "value"=>$data['lastname'],
                    "required"=>false,
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>" Votre nom doit faire entre 2 et 100 caractères",
                ],
                 "email"=>[
                    "placeholder"=>"Email",
                    "type"=>"text",
                    "id"=>"pwdRegister",
                    "class"=>"formparam",
                     "label"=>"",
                    "value"=>$data['email'],
                    "required"=>false,
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>" Votre email doit faire entre 2 et 100 caractères",
                ]
            ]
        ];
    }

    public function updateUser(): array
    {
        $roles = RoleRepository::all();

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
                    "placeholder"=>'New Firstname',
                    "type"=>"text",
                    "id"=>"emailRegister",
                    "class"=>"formparam",
                    "label"=>"",
                    "value"=>"",
                    "required"=>false,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Le prénom doit faire entre 2 et 25 caractères",
                ],
                "lastname"=>[
                    "placeholder"=>'New Lastname',
                    "type"=>"text",
                    "id"=>"pwdRegister",
                    "class"=>"formparam",
                    "label"=>"",
                    "value"=>"",
                    "required"=>false,
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>"Le nom doit faire entre 2 et 100 caractères",
                ],
                "email"=>[
                    "placeholder"=>"New email",
                    "type"=>"email",
                    "id"=>"emailRegister",
                    "class"=>"formparam",
                    "label"=>"",
                    "required"=>true,
                    "error"=>"Email incorrect",
                    "unicity"=>true,
                    "errorUnicity"=>"Un compte existe déjà avec cet email"
                ],
                "role"=>[
                    "type"=>"select",
                    "label"=>"",
                    "id"=>"select",
                    "option"=>  [
                        "1"=>"Abonne",
                        "2"=>"Editeur",
                        "3"=>"Admin",
                    ],
                    "defaultValue" =>  ""
                ]
            ]
        ];
    }

    public function getPasswordResetForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formLogin",
                "class"=>"formLogin",
                "submit"=>"Envoyer"
            ],
            "inputs"=>[
                "email"=>[
                    "placeholder"=>"Votre email ...",
                    "type"=>"email",
                    "id"=>"emailRegister",
                    "label"=>"",
                    "class"=>"formRegister",
                    "required"=>true,
                ]
            ],
            "submit"=>[
                "type"=>"submit",
                "class"=>"button-submit",
                "title"=>"Confirmer",
            ]
        ];
    }

    public function getPasswordInitForm(): array
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
                "password"=>[
                    "placeholder"=>"Nouveau Password",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "label"=>"",
                    "class"=>"formRegister",
                    "required"=>true,
                ],
                "confirm_password"=>[
                    "placeholder"=>"Confirmer Password",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "label"=>"",
                    "class"=>"formRegister",
                    "required"=>true,
                ],
                "submit"=>[
                    "type"=>"submit",
                    "class"=>"button-submit",
                    "title"=>"Confirmer",
                ]
            ]
        ];
    }

    public function getUpdatePwdForm(): array
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
                "oldpassword"=>[
                    "placeholder"=>"Ancien Password",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "label"=>"",
                    "class"=>"formparam",
                    "required"=>true,
                ],
                "password"=>[
                    "placeholder"=>"Nouveau Password",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "label"=>"",
                    "class"=>"formparam",
                    "required"=>true,
                ],
                "confirm_password"=>[
                    "placeholder"=>"Confirmer Password",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "label"=>"",
                    "class"=>"formparam",
                    "required"=>true,
                ]
            ]
        ];
    }

}
