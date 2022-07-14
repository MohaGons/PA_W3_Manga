<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Media as MediaModel;
use App\Core\Mailer;
use App\Core\Session as Session;
use App\Repository\User as UserRepository;
use App\Model\Media as MediaModel;

class Authentification {

    public function login()
    {
        $user = new UserModel();
        $errors = [];

        if(!empty($_POST)) {
            $result = Verificator::checkFormLogin($user->getLoginForm(), $_POST);

            if (empty($result)) {
                $checkLogin = UserRepository::checkLogin($_POST);

                if ($checkLogin == false) {
                    $errors[] = 'Vos identifiants de connexion ne correspondent à aucun compte ';
                }
                else {
                    $role = Session::get("role");

                    switch ($role) {
                        case "Abonne":
                            header('location:'.HOME_ROUTE);
                            break;
                        default:
                            header('location:'.ADMIN_HOME_ROUTE);
                            break;
                    }
                }
            }
            else {
                $errors = $result;
            }
        }

        $view = new View("login");
        $view->assign("user", $user);
        $view->assign("errors", $errors);

    }

    public function logout()
    {
        Session::destroy();
        header('location:'.LOGIN_VIEW_ROUTE);
    }

    public function register()
    {
        $user = new UserModel();
        $media = new MediaModel();
        $errors = [];

        if(!empty($_POST)) {
            //$result = Verificator::checkFormRegister($user->getRegisterForm(), $_POST);

            if (empty($result)) {
                $userRepository = UserRepository::findByEmail(htmlspecialchars($_POST["email"]));

                if (empty($userRepository)) {
                    $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                    $user->setLastname(htmlspecialchars($_POST["lastname"]));
                    $user->setEmail(htmlspecialchars($_POST["email"]));
                    $user->setPassword(htmlspecialchars($_POST["password"]));
                    $user->setGender(htmlspecialchars($_POST["gender"]));
                    $user->setAvatar(htmlspecialchars($_FILES["file"]["name"]));
                    $user->setPays('Pays');
                    $user->setPays('Ville');
                    $user->save();
                    $media->setMedia("Avatars",$_POST["email"],"set");
                    echo "<script>alert('Votre profil a bien été mis à jour')</script>";

                    Session::set('email',$_POST['email']);
                    $destinataire = $_POST["email"];
                    $name = $_POST["firstname"];
                    $lastname = $_POST["lastname"];
                    $subject = 'Inscription MangaSite';
                    $body = 'Bienvenue ' . $name . ' sur MangaSite';
                    Mailer::sendMail($destinataire, $name, $lastname, $subject, $body);

                    $roleId = $user->getRoleByEmail($_POST['email']);

                    $role = $user->getRole($roleId['role']);
                    Session::set('role',$role['role']);
                    header('location:'.HOME_ROUTE);
                }
                else {
                    $errors[]= "Il existe déjà un compte pour l'adresse mail " .$_POST["email"]. ". Veuillez en renseigner un autre.";
                }

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
