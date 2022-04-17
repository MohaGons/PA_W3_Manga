<?php

namespace App\Core;
use App\Core\Sql;
use PDO;
use App\Core\Mailer;
use function App\myAutoloader;
use App\Core\Security as User;
use App\Model\User as UserModel;
class PasswordReset extends Sql
{
    public static function checkFormPasswordReset($config, $data):array
    {
        $errors = array();
        $user = new UserModel();
        $results = $user->checkPasswordReset($data);
        if ($results == false) {
            $errors[] = "<br>Votre Email n'existe pas ";
            return $errors;
        }
        else {

            $user = new User();
            $results = $user->checkPassword($data);
            $errors[] = "Un email a ete envoyé a l'adresse : <strong>".$email."</strong><br>Le lien de recuperation de mot de passe est validé pour 1h";
            return $errors;
        }
    }

    public static function checkFormPasswordInit($config, $data):array
    {
        $errors = array();
        $user = new UserModel();
        // verifier si token existe sinon retour null
        $results = $user->checkPasswordInit($data);
        if ($results != NULL ) {
            if($results==2){
                //$errors[] = "<br>La durée maximum d'une heur est depassé";
                $errors[] = 1;
                return $errors;
            }
            else{
                //$errors[] = "<br>Parfait token egal token";
                $errors[] = $results;
                return $errors;
            }
        }
        else {
            //$errors[] = "Vous avez pas accés au lien";
            $errors[] = 0;
            return $errors;
        }
    }



}