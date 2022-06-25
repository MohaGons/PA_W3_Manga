<?php

namespace App\Controller;
use App\Model\User as UserModel;
use App\Model\Role as RoleModel;
use App\Core\View;
use App\Core\Verificator;
use MongoDB\BSON\Decimal128;

class Admin
{

    public function home()
    {
        $view = new View("dashboard", "back");
    }

    public function utilisateurs(){
        $user = new UserModel();
        $messages = [];
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
        $pagination=6;
        if (isset($_GET['page'])){
            $page=$_GET['page'];
        }
        else{
            $page=1;
        }
        $deb = ($pagination*$page)-$pagination;
        $fin=  $deb+$pagination;
        if($_GET['action']=='date'){
            $users = $user->getAllUsersByDate();
        }
        elseif($_GET['action']=='nom'){
            $users = $user->getAllUsersByName();
        }
        else{
            if (isset($_GET['user'])){
              $search = $_GET['user'];
              $users = $user->searchUser($search);
            }
            else{
                $users = $user->getAllUsers($deb,$fin);
            }
        }
        //$roles = $role->getRole(1);*
        $test= $user->getRoleByEmail('aminecherigui44@gmail.com');
        $Nbusers = count($user->NombreUsers());
        $Nbpages = ceil($Nbusers / $pagination);
        $view = new View("utilisateurs", "back");
        $view->assign("users", $users);
        $view->assign("role", $test);
        $view->assign("Nbusers", $Nbusers);
        $view->assign("Nbpages", $Nbpages);
        $view->assign("messages", $messages);
    }

    public function utilisateurs_update(){
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
