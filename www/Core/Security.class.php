<?php

namespace App\Core;
use App\Model\User as UserModel;
use PDO;
use function App\myAutoloader;

class Security extends Sql
{

    public static function checkRoute($route):bool
    {
        /*
         * /dashboard:
              Controller: admin
              action: home
              security: true
         *
         */
        return true;
    }

    function checkLogin()
    {

        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $q = "SELECT ID FROM mnga_user WHERE email = ? AND password = ?";

        $req = $bdd->prepare($q);
        $req->execute( [$email, $password] );
        $results = $req->fetchAll();
        return $results;


    }
    function checkPassword($data)
    {
        $user = new UserModel();
        $email = $data['email'];
        $date = time();
        $string = implode('',array_merge(range('A','Z'), range('a','z'), range('0','9')));
        $token = substr(str_shuffle($string),0,20);
        //$token = $user->generateToken();
        $q = "INSERT INTO passwords(email,date_demande,token) VALUES  (?,?,?)";
        $req = $this->pdo->prepare($q);
        $req->execute( [$email, $date ,$token] );
        $results = $req->fetchAll();
        return $results;


    }


}