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
        $user = new UserModel();
        /*$messages = [];
        if (isset($_GET['action'])){
            $action = $_GET['action'];
            $id = $_GET['id'];
            if($action=='delete'){
                $res = $user->deleteuser($id);
                if($res==1){
                    $messages[]= "l'utilisateur a été bien supprimé !";
                }
                else{
                    $messages[]= "un erreur est survenue, reesayer plus tard";
                }
            }
        }
*/
//        die("testADMIN");
        $view = new View("admin/user_index", "back");
//        die("testADMIN");
        $view->assign("users", $users);

        $Nbusers = count($user->NombreUsers());
        //$Nbpages = ceil($Nbusers / $pagination);
        $view->assign("Nbusers", $Nbusers);
       // $view->assign("Nbpages", $Nbpages);
        //$view->assign("messages", $messages);
    }

    public function edit($params){
        $id = $params[0];

        if (!empty($id) && is_numeric($id))
        {
            $user = new UserModel();
            $userData = UserRepository::findById($id);
            $messages=[];
            if(!empty($_POST)) {
                $result = Verificator::checkupdateUser($user->updateUser(), $_POST);
                if (empty($result)){
                    $user->setId($id);
                    $user->setLastname(htmlspecialchars($_POST['lastname']));
                    $user->setFirstname(htmlspecialchars($_POST['firstname']));
                    $user->setEmail(htmlspecialchars($_POST['email']));
                    $user->setRole(htmlspecialchars($_POST['role']));
                    $user->save();
                    $messages[] = 'la modification a été faite !';
                }
               else{
                   $messages = $result;
                }
            }
            $view = new View("admin/user_edit", "back");
            $view->assign("user", $user);
            $view->assign("userData", $userData);
            $view->assign("messages", $messages);
        }
        else{
             die("l'user existe pas");
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
            $message = $media->setMedia("Avatars", $email, "updateavatar");
            $errors = $message;
            if ($message == NULL) {
                header('Location: ./parametre');
            }
        }
        if (isset($_GET['avatar'])) {
            $nom = htmlspecialchars($_GET['avatar']);
            $media->updateAvatar($nom, $session->get('email'));
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
        $session = new Session();
        $email = $_GET['email'];
        if ($email == $session->get('email')) {
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
