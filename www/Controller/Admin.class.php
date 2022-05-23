<?php

namespace App\Controller;
use App\Model\User as UserModel;
use App\Core\View;
use App\Core\Verificator;
use MongoDB\BSON\Decimal128;

class Admin{


    public function home()
    {
        //Connecté à la bdd
        //j'ai récup le prenom
        $firstname = "Yves";

        $view = new View("dashboard", "back");
        $view->assign("firstname", $firstname);
        $view->assign("lastname", "SKRZYPCZYK");
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
            if($action=='update'){

            }
            if ($action=='contact'){

            }
        }
        $users = $user->getAllUsers();
        $Nbusers = count($users);
        $view = new View("utilisateurs", "back");
        $view->assign("users", $users);
        $view->assign("Nbusers", $Nbusers);
        $view->assign("messages", $messages);
    }

    public function utilisateurs_update(){
        $user = new UserModel();
        $messages=[];
        $id = $_GET['id'];
       /* $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];*/
        if(!empty($_POST)) {
            $result = Verificator::checkupdateUser($user->updateUser(), $_POST);
            if (empty($result)){
                $user->setFirstnameId( $_POST['firstname'],$id);
                $user->setLastnameId($_POST['lastname'],$id);
                $user->setEmailId($_POST['email'],$id);
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