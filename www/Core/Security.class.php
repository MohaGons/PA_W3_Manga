<?php

namespace App\Core;

class Security
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

        $role = "admn";

        if (in_array($role, $route["role"])) {
            return true;
        }
        else {
            return false;

        }
    }

    function checkLogin()
    {
        try
        {
            $bdd = new PDO('mysql:host=database;dbname=pa_database', 'root', 'password');
        }
        catch(\Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $q = "SELECT ID FROM mnga_user WHERE email = ? AND password = ?";

        $req = $bdd->prepare($q);
        $req->execute( [$email, $password] );
        $results = $req->fetchAll();
        return $results;


    }


}