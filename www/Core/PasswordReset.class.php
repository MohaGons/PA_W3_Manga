<?php

namespace App\Core;
use App\Model\User as UserModel;

class PasswordReset
{
    public static function checkFormPasswordReset($config, $data): array
    {
        $errors = array();
        $user = new UserModel();
        $results = $user->checkPasswordReset($data);
        if ($results == false) {
            $errors[] = "Votre Email n'existe pas ";
            return $errors;
        }
        else {
            $errors[] = "Un email a ete envoyé a l'adresse : <strong>".$data['email']."</strong>";

            return $errors;
        }
    }
}