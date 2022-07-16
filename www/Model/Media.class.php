<?php

namespace App\Model;
use App\Core\MysqlBuilder;
use PDO;
class Media extends MysqlBuilder{

    protected $id = null;
    protected $name = null;
    protected $categorie = null;
    protected $user = null;
    protected $date = null;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie($categorie){
        $this->categorie = $categorie;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function setMedia($categorie,$email,$action){
        $messages = [];
        if (isset($_FILES)) {
            $target_dir = __DIR__ .'/../Style/images/'.$categorie.'/';
            if (!file_exists($target_dir) && !is_dir($target_dir))
            {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (isset($_POST)) {

                // verifier l'existance de l'image
                if (file_exists($target_file)) {
                    $messages[] = "Désolé, le fichier est deja telechargé";
                }
                // verifier la taille de l'image
                else if ($_FILES["file"]["size"] > 500000) {
                    $messages[] =  "Désolé, le fichier ne doit pas depassé 62,5 ko ";
                }
                // Verifier format d'image
                else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    $messages[] =  "Désolé, les format accepté : .png .jpg .jpeg .gif ";
                }
                else{
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

                            $q = "INSERT INTO mnga_media (name,categorie,user,createdAt) VALUES (?,?,?,?)";
                            $req = $this->pdo->prepare($q);
                            $req->execute([$_FILES["file"]["name"],$categorie,$email,date("Y-m-d H:i:s")]);
                            $messages[] = "Telechargement reussi";
                            if ($action=="updateavatar"){
                                $q = "UPDATE mnga_user SET avatar=? WHERE email=?";
                                $req = $this->pdo->prepare($q);
                                $req->execute([$_FILES["file"]["name"],$email]);
                            }

                    } else {
                        $messages[] = "Telechargement failed, ressayer plus tard";
                    }
                }

            }
        }
        return $messages;
    }

    public function getAvatar($email){
        $q = "SELECT avatar FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        return $req->fetch();
    }

    public function getAllMedia($email){
        $q = "SELECT * FROM mnga_media WHERE user = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        return $req->fetchAll();
    }
    public function deteleMedia($name,$categorie){
        $target_dir = __DIR__.'/../Style/images/'.$categorie.'/'.$name;
        if(file_exists($target_dir))
        {
            unlink($target_dir);
        }
        $q = "DELETE FROM mnga_media WHERE name = :nom AND categorie = :categorie";
        $req = $this->pdo->prepare($q);
        $req->execute(['nom' => $name, 'categorie' => $categorie ]);
    }
    public function updateAvatar($name, $email){
        $q = "UPDATE mnga_user SET avatar=? WHERE email=?";
        $req = $this->pdo->prepare($q);
        $req->execute([$name,$email]);
    }

    public function updateEvenement($name, $nameE){
        $q = "UPDATE mnga_event SET photo=? WHERE name=?";
        $req = $this->pdo->prepare($q);
        $req->execute([$name,$nameE]);
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
     * @param null $updateAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

}