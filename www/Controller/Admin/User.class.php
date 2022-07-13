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



}
