<?php

namespace App\Controller\Admin;

use App\Core\Security as Security;
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
        $bestPays = $user->getBestPays();
        $view = new View("admin/user_index", "back");
        $view->assign("users", $users);
        $Nbusers = count($user->NombreUsers());
        $view->assign("Nbusers", $Nbusers);
        $view->assign("bestpays", $bestPays);
    }

    public function edit($params){
        $id = $params[0];

        if (!empty($id) && is_numeric($id))
        {
            $user = new UserModel();
            $userData = UserRepository::findById($id);
            $messages=[];
            if(!empty($_POST)) {
                $result = Verificator::checkupdateUser($user->updateUser($userData), $_POST);
                if (empty($result)){
                    $user->setId($id);
                    $user->setLastname(htmlspecialchars($_POST['lastname']));
                    $user->setFirstname(htmlspecialchars($_POST['firstname']));
                    $user->setEmail(htmlspecialchars($_POST['email']));
                    $user->setRole(htmlspecialchars($_POST['role']));
                    $user->save();
                    $messages[] = 'la modification a été faite !';
                    header("Location: /admin/utilisateurs");
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
        else {
            Security::returnHttpResponseCode(404);
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

        $view = new View("admin/parametre", "back");
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

    public function delete($id)
    {
        $user_Id = $id[0];

        if (!empty($user_Id) && is_numeric($user_Id))
        {
            $manga_delete = UserRepository::delete($user_Id);
        }
        else {
            Security::returnHttpResponseCode(404);
        }
    }



}
