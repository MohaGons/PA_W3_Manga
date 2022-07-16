<?php

namespace App\Model;

use App\Core\MysqlBuilder;
use PDO;

class Password extends MysqlBuilder
{

    public function UpdateStatut($Nb,$Email){
      $q = "UPDATE mnga_password SET  statut = :nb WHERE email = :email";
      $req = $this->pdo->prepare($q);
      $req->execute( ['nb'=> $Nb, 'email' => $Email] );
      $req->fetch();
    }
    public function checkPasswordReset($data)
    {

        $email = htmlspecialchars($data['email']);
        $q = "SELECT * FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        $results = $req->fetch();
        if ($results > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function checkPasswordInit($data)
    {

        $email = htmlspecialchars($_GET['email']);
        $token = htmlspecialchars($_GET['token']);
        //$email = "amine@gmail.com";
        $q = "SELECT * FROM mnga_password WHERE email = :email ORDER BY id DESC";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        $results = $req->fetch();
        if (!empty($results)) {
            if($token==$results['token'] && $results['statut']==0){
                $date_action = time();
                if($date_action-$results['date_demande']>3600){
                    $results = 2;
                    return $results;
                }
                else{
                    $results = $results['token'];
                    return $results;
                }
            }
            else{
                //Token incorrect
                $results = NULL;
                return $results;
            }

        } else {
            //email n'exist pas
            $results = NULL;
            return $results;
        }

    }

    public function NewPassword(string $Password, string $Email)
    {
        $q = "UPDATE mnga_user SET  password = :password WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute( ['password'=> $Password, 'email' => $Email] );
    }

    public function getPassword($email){
        $q = "SELECT password FROM mnga_user WHERE email = :email";
        $req = $this->pdo->prepare($q);
        $req->execute(['email' => $email]);
        return $req->fetch();
    }

    public function verifiemdp($mdp, $email)
    {
        $oldmdp = $this->getPassword($email);
        if (password_verify($mdp,$oldmdp['password'])){
          return true;
        }
        return false;
    }

}
