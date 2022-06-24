<?php

namespace App\Model;
use App\Core\MysqlBuilder;
use PDO;
class Media extends MysqlBuilder{
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

                            $q = "INSERT INTO mnga_media (nom,categorie,user) VALUES (?,?,?)";
                            $req = $this->pdo->prepare($q);
                            $req->execute([$_FILES["file"]["name"],$categorie,$email]);
                            $messages[] = "Telechargement reussi";

                        if ($action==="update"){
                            $q = "UPDATE mnga_user SET avatar=? WHERE email=?";
                            $req = $this->pdo->prepare($q);
                            $req->execute([$_FILES["file"]["name"],$email]);
                            $messages=NULL;
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
        $q = "DELETE FROM mnga_media WHERE nom = :nom AND categorie = :categorie";
        $req = $this->pdo->prepare($q);
        $req->execute(['nom' => $name, 'categorie' => $categorie ]);
    }
    public function updateAvatar($name, $email){
        $q = "UPDATE mnga_user SET avatar=? WHERE email=?";
        $req = $this->pdo->prepare($q);
        $req->execute([$name,$email]);
    }
}