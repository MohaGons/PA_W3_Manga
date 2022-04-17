<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\PasswordReset;
use App\Core\View;
use App\Model\User as UserModel;
use App\Core\Mailer;

class User {

    public function login()
    {
        $user = new UserModel();
            $errors = [];

        if(!empty($_POST)) {

                $result = Verificator::checkFormLogin($user->getLoginForm(), $_POST);
                if (!empty($result)) {
                    $errors = $result;
//                    die(var_dump($errors));
                } else {
                    session_start();
                    $_SESSION['email'] = $_POST['email'];
                    header('location:'.DASHBOARD_VIEW_ROUTE);
                }

            }
            $view = new View("login");
            $view->assign("user", $user);
            $view->assign("errors", $errors);

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

            if (empty($result)) {
                $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                $user->setLastname(htmlspecialchars($_POST["lastname"]));
                $user->setEmail(htmlspecialchars($_POST["email"]));
                $user->setPassword(htmlspecialchars($_POST["password"]));
                $user->setGender(htmlspecialchars($_POST["gender"]));
                $user->setAvatar(htmlspecialchars($_POST["avatar"]));

                $user->save();
                echo "<script>alert('Votre profil a bien été mis à jour')</script>";

                $destinataire = $_POST["email"];
                $name = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $subject = 'test';
                $body = 'test';

                Mailer::sendMail($destinataire, $name, $lastname, $subject, $body);
            }
            else {
                $errors = $result;
            }
        }

        $view = new View("Register");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }


    public function  recuperer_mdp()
    {
        $user = new UserModel();
        $errors = [];

        if(!empty($_POST)) {

            $result = PasswordReset::checkFormPasswordReset($user->getPasswordResetForm(), $_POST);
            if (!empty($result)) {
                $errors = $result;
            } else {
                $errors = $result;
            }

        }

        $view = new View("mot_passe_oublier");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }

    public function  initialiser_mdp()
    {
        $user = new UserModel();
        $errors = [];
        $token  = $_GET['token'];
        $email  = $_GET['email'];
        if (isset($token)){

            $result = PasswordReset::checkFormPasswordInit($user->getPasswordInitForm(), $_POST);
            if ($result[0]===1){
                echo "<script>alert('Vous avez depassé 1h pour reinitialiser votre Mot de passe')</script>";
            }
            if ($result[0]===0){
                echo "<script>alert('Vous n\'avez effectuer aucun demande d\'initialisation du mot de passe')</script>";
            }
            else{
                if(!empty($_POST)) {
                    $password = $_POST["password"];
                    $password_c = $_POST["confirm_password"];
                    if ($password == $password_c){
                        //$user->setPassword($password);
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $user->NewPassword($password,$email);
                        $errors[] = "<br>Votre mot de passe est modefié<br><a href='login'>Se connecter</a>";
                    }
                    else{
                        $errors[] = "<br>Verifier que vous avez mis le meme password dans les deux champs";
                    }

                }
                $view = new View("mot_passe_initier");
                $view->assign("user", $user);
                $view->assign("errors", $errors);
            }
        }
        else{
            echo "<script>alert('Vous n\'avez effectuer aucun demande d\'initialisation du mot de passe')</script>";
        }
    }


}
