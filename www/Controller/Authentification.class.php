<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Media as MediaModel;
use App\Core\Mailer;
use App\Core\Session as Session;
use App\Repository\Role as RoleRepository;
use App\Repository\User as UserRepository;

class Authentification {

    public function login()
    {
        if (!empty(Session::get("role")))
        {
            switch (Session::get("role")){
                case "Abonne":
                    header('location:'.HOME_ROUTE);
                    break;
                default:
                    header('location:'.ADMIN_HOME_ROUTE);
                    break;
            }
        }
        else{
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
    }

    public function logout()
    {
        Session::destroy();
        header('location:'.LOGIN_VIEW_ROUTE);
    }

    public function register()
    {
        if (!empty(Session::get("role")))
        {
            switch (Session::get("role")){
                case "Abonne":
                    header('location:'.HOME_ROUTE);
                    break;
                default:
                    header('location:'.ADMIN_HOME_ROUTE);
                    break;
            }
        }
        else
        {
            $user = new UserModel();
            $media = new MediaModel();
            $errors = [];

            if(!empty($_POST) && !empty($_FILES)) {
                $data = array_merge($_POST, $_FILES);
                $result = Verificator::checkFormRegister($user->getRegisterForm(), $data);


                if (empty($result)) {
                    $userRepository = UserRepository::findByEmail(htmlspecialchars($_POST["email"]));

                    if (empty($userRepository)) {
                        $token = substr(str_shuffle(bin2hex(random_bytes(128)  )), 0, 255);

                        $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                        $user->setLastname(htmlspecialchars($_POST["lastname"]));
                        $user->setEmail(htmlspecialchars($_POST["email"]));
                        $user->setPassword(htmlspecialchars($_POST["password"]));
                        $user->setGender(htmlspecialchars($_POST["gender"]));
                        $user->setAvatar(htmlspecialchars($_FILES["file"]["name"]));
                        $user->setPays('Pays');
                        $user->setPays('Ville');
                        $user->setCreatedAt(date("Y-m-d H:i:s"));
                        $user->generateToken($token);
                        $persist = $user->save();

                        if ($persist == true)
                        {
                            $media->setMedia("Avatars",$_POST["email"],"set");
                            echo "<script>alert('Votre profil a bien été crée')</script>";

                            $id_contact = UserRepository::findByEmail($_POST['email']);



                            Session::set('id', $id_contact["id"]);
                            Session::set('email', $_POST['email']);
                            Session::set('token', $token);
                            $role = RoleRepository::getRoleName($user->getRole());
                            Session::set('role', $role['role']);
                            $destinataire = $_POST["email"];
                            $name = $_POST["firstname"];
                            $lastname = $_POST["lastname"];
                            $subject = 'Inscription MangaSite';
                            $body = 'Bienvenue ' . $name . ' sur MangaSite';
                            Mailer::sendMail($destinataire, $name, $lastname, $subject, $body);

                            header('location:'.HOME_ROUTE);
                        }
                        else {
                            echo "<script>alert('Votre inscription a echoué')</script>";
                        }

                    }
                    else {
                        $errors[]= "Il existe déjà un compte pour l'adresse mail " .$_POST["email"]. ". Veuillez en renseigner un autre.";
                    }

                }
                else {
                    $errors = $result;
                }
            }

            $view = new View("register");
            $view->assign("user", $user);
            $view->assign("errors", $errors);
        }
    }
}
