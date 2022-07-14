<?php

namespace App\Controller\Admin;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\PasswordReset;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Password as PasswordModel;
use App\Model\Category;
use App\Model\Forum;
use App\Core\Mailer;
use App\Core\Session as Session;
use App\Model\Media as MediaModel;
use App\Model\Manga;
use App\Repository\User as UserRepository;
use function Couchbase\basicEncoderV1;


class User {

    public function index(){
        $users = UserRepository::all();
//        die("testADMIN");
        $view = new View("admin/user_index", "back");
//        die("testADMIN");
        $view->assign("users", $users);
    }

    public function edit($params){
        $id = $params[0];
//        die(var_dump($id));
        if (!empty($id) && is_numeric($id))
        {
            $user = new UserModel();
            $user->setFirstname();
            $user->setLastname();
            $user->setRole();
            $user->setFirstname();
            $user->setFirstname();
            $userData = UserRepository::findById($id);
            if (!empty($user)) {
//                echo "<pre>";
//                die(var_dump($user));
                $messages=[];
//            if(!empty($_POST)) {
//                $result = Verificator::checkupdateUser($user->updateUser(), $_POST);
//                if (empty($result)){
//                    if(!empty($_POST["firstname"])){
//                        $user->updateFirstnameId( $_POST['firstname'],$id);
//                    }
//                    if(!empty($_POST["lastname"])){
//                        $user->updateLastnameId($_POST['lastname'],$id);
//                    }
//                    if(!empty($_POST["email"])){
//                        $user->updateEmailId($_POST['email'],$id);
//                    }
//                    if(!empty($_POST["role"])){
//                        $user->updateRole($_POST['role'],$id);
//                    }
//                    $messages[] = 'la modification a été faite !';
//                }
//                else{
//                    $messages = $result;
//                }
//            }
                $view = new View("admin/user_edit", "back");

                $view->assign("user", $user);
                $view->assign("userData", $userData);
                $view->assign("messages", $messages);
            }
            else{
                die("l'user existe pas");
            }

        }
        else {
            die("ytuiop");
        }

    }

    public function parametre()
    {
        $user = new UserModel();
        $session = new Session();
        $media = new MediaModel();
        $email = $session->get('email', '');
        $lastname = $user->getLastname($email);
        $firstname = $user->getFirstname($email);
        $gender = $user->getGender($email);
        $avatar = $user->getAvatar($email);
        if (!empty($_POST)) {
            if (!empty($result)) {
                $result = Verificator::checkFormParam($user->getParamForm($data), $_POST);
            }

            if (empty($result)) {
                if (!empty($_POST["lastname"])) {
                    $lastname = $_POST["lastname"];
                    $user->updateLastname($lastname, $email);
                }
                if (!empty($_POST["firstname"])) {
                    $firstname = $_POST["firstname"];
                    $user->updateFirstname($firstname, $email);
                }
            } else {
                $errors = $result;
            }
        }
        if (isset($_POST['file'])) {
            $message = $media->setMedia("Avatars", $_SESSION['email'], "update");
            $errors = $message;
            if ($message == NULL) {
                header('Location: ./parametre');
            }
        }
        if (isset($_GET['avatar'])) {
            $nom = htmlspecialchars($_GET['avatar']);
            $media->updateAvatar($nom, $_SESSION['email']);
            $errors[] = "Votre Avatar est mise a jour avec succes";
            header('Location: ./parametre');
        }

        $view = new View("parametre", "back");
        $data = array(
            "email" => $email,
            "lastname" => $lastname,
            "firstname" => $firstname,
            "gender" => $gender,
            "avatar" => $avatar
        );
        $view->assign("data", $data);
        $view->assign("user", $user);
        if (!empty($errors)) {
            $view->assign("errors", $errors);
        }
    }

    public function deletecompte()
    {
        $user = new UserModel;
        $email = $_GET['email'];
        if ($email == $_SESSION['email']) {
            $user->deletecompte($email);
            if ($user == 1) {
                echo "<script>alert('Votre compte a bien été supprimer')</script>";
            } else {
                echo "<script>alert('Reessayer plus tard')</script>";
            }
        } else {
            header('location:' . LOGIN_VIEW_ROUTE);
        }
    }



}
