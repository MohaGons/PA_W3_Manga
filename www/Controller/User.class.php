<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User {


    public function login()
    {
        $view = new View("login");
        $view->assign("title", "Ceci est le titre de la page login");
    }

    public function logout()
    {
        echo "Se déconnecter";
    }


    public function register()
    {
        $user = new UserModel();

        if (isset($_POST['submit'])){
            $errors = Verificator::checkForm($user->getRegisterForm(), $_POST);
            if(!empty($_POST)) {
                if(empty($errors)){

					$user->setFirstname(htmlspecialchars($_POST["firstname"]));
					$user->setLastname(htmlspecialchars($_POST["lastname"]));
					$user->setEmail(htmlspecialchars($_POST["email"]));
					$user->setPassword(password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT));
                    $user->setGender(htmlspecialchars($_POST["gender"]));
					$user->setAvatar(password_hash(htmlspecialchars($_POST["avatar"]), PASSWORD_BCRYPT));

					$user->save();
					echo "<script>alert('Votre profil a bien été mis à jour')</script>";
				} else{
					print_r($errors);
				}
            }
        }


        $view = new View("Register");
        $view->assign("user", $user);
    }




}











