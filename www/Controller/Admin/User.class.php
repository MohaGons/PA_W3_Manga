<?php

namespace App\Controller;

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


class User {

    public function index(){
        $users = UserRepository::all();

        $view = new View("admin/user_index", "back");
        $view->assign("users", $users);
    }

    public function edit($id){
        if (!empty($id) && is_numeric($id))
        {

        }
        $user = new UserModel();
        $messages=[];
        $id = $_GET['id'];
        if(!empty($_POST)) {
            $result = Verificator::checkupdateUser($user->updateUser(), $_POST);
            if (empty($result)){
                if(!empty($_POST["firstname"])){
                    $user->updateFirstnameId( $_POST['firstname'],$id);
                }
                if(!empty($_POST["lastname"])){
                    $user->updateLastnameId($_POST['lastname'],$id);
                }
                if(!empty($_POST["email"])){
                    $user->updateEmailId($_POST['email'],$id);
                }
                if(!empty($_POST["role"])){
                    $user->updateRole($_POST['role'],$id);
                }
                $messages[] = 'la modification a été faite !';
            }
            else{
                $messages = $result;
            }
        }
        $view = new View("update_user", "back");
        $view->assign("user", $user);
        $view->assign("messages", $messages);
    }



}
