<?php

namespace App\Core;

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

      /*  try
        {
            $bdd = new PDO('mysql:host=database;dbname=pa_database', 'root', 'password');
        }
        catch(\Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }*/

        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $q = "SELECT ID FROM mnga_user WHERE email = ? AND password = ?";

        $req = $bdd->prepare($q);
        $req->execute( [$email, $password] );
        $results = $req->fetchAll();
        return $results;


    }


}