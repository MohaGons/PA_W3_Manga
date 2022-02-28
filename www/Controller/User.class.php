<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User {


    public function login()
    {
       // if (session_start()==NULL){
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


        if(!empty($_POST)) {

            $result = Verificator::checkForm($user->getRegisterForm(), $_POST);

            print_r($result);
        }


        $view = new View("Register");
        $view->assign("user", $user);
    }




}











