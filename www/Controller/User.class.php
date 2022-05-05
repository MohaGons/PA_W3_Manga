<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Category;

class User {


    public function login()
    {
        $view = new View("login");
        $view->assign("title", "Ceci est le titre de la page login");
    }

    public function logout()
    {
        echo "Se déconnecter";
    }


    public function register()
    {
        $user = new UserModel();

        if(!empty($_POST)) {

            $result = Verificator::checkForm($user->getRegisterForm(), $_POST);
            print_r($result);

            if (empty($result)) {
                $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                $user->setLastname(htmlspecialchars($_POST["lastname"]));
                $user->setEmail(htmlspecialchars($_POST["email"]));
                $user->setPassword(password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT));
                $user->setGender(htmlspecialchars($_POST["gender"]));
                $user->setAvatar(password_hash(htmlspecialchars($_POST["avatar"]), PASSWORD_BCRYPT));

                $user->save();
                echo "<script>alert('Votre profil a bien été mis à jour')</script>";
            }
        }
        


        $view = new View("Register");
        $view->assign("user", $user);
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


}











