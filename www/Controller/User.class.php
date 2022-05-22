<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Category;
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
