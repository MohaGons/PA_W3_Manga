<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Category;
use App\Model\Forum;

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

    public function forum()
    {
        $forum = new Forum();

        if(!empty($_POST)) {

            $result = Verificator::checkForm($forum->getForumForm(), $_POST);
            print_r($result);

            if (empty($result)) { 
                $forum->setTitleForum(htmlspecialchars($_POST["title"]));
                $forum->setDescriptionForum(htmlspecialchars($_POST["description"]));
                $forum->setPictureForum(htmlspecialchars($_POST["picture"]));
                $forum->setUserId(1);
                $forum->save();
                echo "<script>alert('Votre forum a bien été mis " .$_FILES['picture']['tmp_name']." à jour')</script>";
            }
        }
        
        $view = new View("forum", "back");
        $view->assign("forum", $forum);

        $forums_data = $forum->getForums();        
        $view->assign("forums_data", $forums_data);
    }

    public function deleteForum()
    {
        $forum = new Forum();
        if(!empty($_POST['forum_id'])){
			$forum_Id = $_POST['forum_id'];
            $forum->deleteForum($forum_Id);
        }
    }

    public function editForum()
    {
        $forum = new Forum();
        $view = new View("edit-forum", "back");
        $view->assign("forum", $forum);
        
        if(!empty($_POST)){
			$forum->setId($_GET["id"]);
			$forum->setTitleForum(htmlspecialchars($_POST["title"]));
            $forum->setDescriptionForum(htmlspecialchars($_POST["description"]));
            $forum->setPictureForum(htmlspecialchars($_POST["picture"]));
            $forum->setUserId(1);
            $forum->save();
            echo "<script>alert('Votre forum a bien été mis à jour')</script>";
		}

        $forum_data = $forum->getForum($forum->setId($_GET["id"]));        
        $view->assign("forum_data", $forum_data);
    }

    public function apparence()
    {
        $view = new View("apparence", "back");
    }

}











