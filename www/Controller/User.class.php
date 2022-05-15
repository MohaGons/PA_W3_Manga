<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
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
    public function parametre(){
        $user = new UserModel();
        $email = $_SESSION['email'];
        $lastname = $user->getLastname($email);
        $firstname = $user->getFirstname($email);
        $gender = $user->getGender($email);
        $avatar = $user->getAvatar($email);
        if(!empty($_POST)) {
            $result = Verificator::checkFormParam($user->getParamForm($data), $_POST);
            if (empty($result)){
                if (!empty($_POST["lastname"]))
                {
                $lastname =$_POST["lastname"];
                $user->setLastname($lastname,$email);
                }
                if (!empty($_POST["firstname"])){
                $firstname = $_POST["firstname"];
                $user->setFirstname($firstname,$email);
                }
           }
            else{
                $errors = $result;
            }
        }
        $view = new View("parametre", "back");
        $data= array(
            "email"=>$email,
            "lastname"=>$lastname,
            "firstname"=>$firstname,
            "gender"=>$gender,
            "avatar"=>$avatar
        );
        $view->assign("data",$data);
        $view->assign("user",$user);
        $view->assign("errors",$errors);
    }

    public function deletecompte(){
        $user = new UserModel;
        $email = $_GET['email'];
        if ($email == $_SESSION['email']){
            $user->deletecompte($email);
            if($user==1){
                echo "<script>alert('Votre compte a bien été supprimer')</script>";
            }
            else{
                echo "<script>alert('Reessayer plus tard')</script>";
            }
        }
        else{
            header('location:'.LOGIN_VIEW_ROUTE);
        }
    }

}
