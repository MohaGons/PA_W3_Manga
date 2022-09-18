<?php

namespace App\Controller\Admin;

use App\Core\Security as Security;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Core\ConnectionPDO;

use App\Core\Session as Session;
use App\Model\Media as MediaModel;
use App\Repository\User as UserRepository;


class Setting {

    public function index(){

        $user = new UserModel();
        $session = new Session();
        $media = new MediaModel();
        $email = $session->get('email', '');
        $lastname = $user->getLastname($email);
        $firstname = $user->getFirstname($email);
        $gender = $user->getGender($email);
        $avatar = $user->getAvatar($email);

        if (isset($_POST['file'])) {
            $message = $media->setMedia("Avatars", $email, "updateavatar");
            $errors = $message;
            if ($message == NULL) {
                header('Location: ./parametre');
            }
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

    public function edit_info()
    {
        $user = new UserModel();
        $connectionPDO = new ConnectionPDO();
        $session = new Session();
        $email = $session->get('email', '');
        if (!empty($_POST)) {
            if (!empty($result)) {
                $result = Verificator::checkFormParam($user->getParamForm($data), $_POST);
            }

            $user->select(["id"]);
            $user->where("email", $email, "=");
            $reqt = $connectionPDO->pdo->prepare($user->getQuery());
            $reqt->execute();
            $user_id = $reqt->fetchAll();

            if (empty($result)) {
                if (!empty($_POST["lastname"])) {
                    $lastname = $_POST["lastname"];
                    $user->updateLastname($lastname, $email);
                }
                if (!empty($_POST["firstname"])) {
                    $firstname = $_POST["firstname"];
                    $user->updateFirstname($firstname, $email);
                }
                if (!empty($_POST["email"])) {
                    $email = $_POST["email"];
                    $user->updateEmailId($email, $user_id[0]['id']);
                    Session::set('email', $_POST['email']);
                }

                header("Location: /admin/parametre");
            } else {
                $errors = $result;
            }
        }
    }

    public function edit_avatar($params) {
        $avatar = $params[0];

        if (!empty($avatar))
        {
            $session = new Session();
            $media = new MediaModel();
            $user = new UserModel();
            $email = $session->get('email', '');
            $lastname = $user->getLastname($email);
            $firstname = $user->getFirstname($email);
            $gender = $user->getGender($email);

            $nom = htmlspecialchars($avatar);
            $media->updateAvatar($nom, $session->get('email'));
            $errors[] = "Votre Avatar est mise a jour avec succes";
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
            $view->assign("errors", $errors); 

        }
        else {
            Security::returnHttpResponseCode(404);
        }
    }

    public function edit_file() {

        if (!empty($_POST['file'])) {

            $session = new Session();
            $media = new MediaModel();
            $email = $session->get('email', '');

            $message = $media->setMedia("Avatars", $email, "updateavatar");
            $errors = $message;
            if ($message == NULL) {
                header('Location: /admin/parametre');
            }
            else {
                header('Location: /admin/parametre');
            }
        }

    }

    public function deletecompte($params){
        $email = $params[0];

        if (!empty($email))
        {
            $userId = UserRepository::findByEmail($email);
            $userId = $userId["id"];
            if (!empty($userId) && is_numeric($userId))
            {

                $manga_delete = UserRepository::delete($userId);
                Session::destroy();
                header('location:'.LOGIN_VIEW_ROUTE);
            }
            else {
                Security::returnHttpResponseCode(404);
            }

        }
        else {
            Security::returnHttpResponseCode(404);
        }


    }



}
