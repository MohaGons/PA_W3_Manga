<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User {


    public function login()
    {
            $user = new UserModel();
            if(!empty($_POST)) {

                $result = (new \App\Model\User)->checkLogin();
                if (count($result) == 0) {
                    echo "Identifiant incorrect";
                } else {
                    session_start();
                    $_SESSION['email'] = $_POST['email'];
                    header('location:../View/dashboard.view.php');
                }

            }
            $view = new View("login");
            $view->assign("user", $user);
        //}
        //else{
        //    header('location:../View/dashboard.view.php');
        //}

    }


    public function logout()
    {
        echo "Se déconnecter";
    }


    public function register()
    {
        $user = new UserModel();
        $errors = [];

        if(!empty($_POST)) {

            $result = Verificator::checkFormRegister($user->getRegisterForm(), $_POST);
            print_r($result);


            if (empty($result)) {
                $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                $user->setLastname(htmlspecialchars($_POST["lastname"]));
                $user->setEmail(htmlspecialchars($_POST["email"]));
                $user->setPassword(password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT));
                $user->setGender(htmlspecialchars($_POST["gender"]));
                $user->setAvatar(password_hash(htmlspecialchars($_POST["avatar"]), PASSWORD_BCRYPT));

                $user->save();
                echo "<script>alert('Votre profil a bien été mis à jour')</script>";
            }
            else {
                $errors = $result;
            }
        }
        


        $view = new View("Register");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }




}











