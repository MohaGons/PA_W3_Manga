<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Category;
use App\Core\Mailer;
use App\Core\Session as Session;


class User {

    public function login()
    {
        $session = New Session();
        $user = new UserModel();
        $errors = [];

        if(!empty($_POST)) {

                $result = Verificator::checkFormLogin($user->getLoginForm(), $_POST);
                if (!empty($result)) {
                    $errors = $result;
//                    die(var_dump($errors));
                } else {
                    $session->ensureStarted();
                    $session->setd('email',$_POST['email']);
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
        $session = New Session();
        $session->sessionDestroy();
        header('location:'.LOGIN_VIEW_ROUTE);
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
        $session = New Session();
        $email= $session->get('email','');
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
                $user->updateLastname($lastname,$email);
                }
                if (!empty($_POST["firstname"])){
                $firstname = $_POST["firstname"];
                $user->updateFirstname($firstname,$email);
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


    public function category()
    {
        $category = new Category();

        if(!empty($_POST)) {

            $result = Verificator::checkForm($category->getCategoryForm(), $_POST);
            print_r($result);

            if (empty($result)) {
                $category->setNameCategory(htmlspecialchars($_POST["name"]));
                $category->setDescriptionCategory(htmlspecialchars($_POST["description"]));
                $category->save();
                echo "<script>alert('Votre catégorie a bien été mis à jour')</script>";
            }
        }
        
        $view = new View("category", "back");
        $view->assign("category", $category);

        $categorie_data = $category->getCategories();        
        $view->assign("categorie_data", $categorie_data);
    }

    public function deleteCategory()
    {
        $category = new Category();
        if(!empty($_POST['category_id'])){
			$category_Id = $_POST['category_id'];
            $category->deleteCategory($category_Id);
        }
    }

    public function editCategory()
    {
        $category = new Category();
        $view = new View("edit-category", "back");
        $view->assign("category", $category);
        
        if(!empty($_POST)){
			$category->setId($_GET["id"]);
			$category->setNameCategory(htmlspecialchars($_POST["name"]));
            $category->setDescriptionCategory(htmlspecialchars($_POST["description"]));
            $category->save();
            echo "<script>alert('Votre catégorie a bien été mis à jour')</script>";
		}
    }

}
