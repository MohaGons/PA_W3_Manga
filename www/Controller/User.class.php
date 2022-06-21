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


class User {

    public function login()
    {
        $session = New Session();
        $user = new UserModel();
        $errors = [];
        if(!empty($_POST)) {

                $result = $user->checkLogin($_POST);
                if ($result==false) {
                    $errors[] = 'Vos identifiants de connexion ne correspondent à aucun compte ';
                } else {
                    $session->ensureStarted();
                    $session->set('email',$_POST['email']);
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
        $session->delete('email');
        $session->sessionDestroy();
        header('location:'.LOGIN_VIEW_ROUTE);
    }

    public function register()
    {
        $session = New Session();
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
                $session->ensureStarted();
                $session->set('email',$_POST['email']);
                $destinataire = $_POST["email"];
                $name = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $subject = 'test';
                $body = 'test';
                Mailer::sendMail($destinataire, $name, $lastname, $subject, $body);
                header('location:'.DASHBOARD_VIEW_ROUTE);
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
    public function manga()
    {
        $manga = new Manga();

        if(!empty($_POST)) {

            $result = Verificator::checkFormRegister($manga->getMangaForm(), $_POST);
            print_r($result);

            if (empty($result)) {
                $manga->setTypeManga(htmlspecialchars($_POST["type"]));
                $manga->setTitleManga(htmlspecialchars($_POST["title"]));
                $manga->setDescriptionManga(htmlspecialchars($_POST["description"]));
                $manga->setImageManga(htmlspecialchars($_POST["image"]));
                $manga->setReleaseDateManga(htmlspecialchars($_POST["releaseDate"]));
                $manga->setAuthorManga(htmlspecialchars($_POST["author"]));
                $manga->setStatusManga(htmlspecialchars($_POST["status"]));
                $manga->setCategoryManga(htmlspecialchars($_POST["category"]));
                $manga->setNbTomesManga(htmlspecialchars($_POST["nbTomes"]));
                $manga->setNbChaptersManga(htmlspecialchars($_POST["nbChapters"]));
                $manga->setNbEpisodesManga(htmlspecialchars($_POST["nbEpisodes"]));
                $manga->setDiffusionManga(htmlspecialchars($_POST["diffusion"]));
                $manga->setNbSeasonsManga(htmlspecialchars($_POST["nbSeasons"]));
                $manga->setProductionStudioManga(htmlspecialchars($_POST["productionStudio"]));
                $manga->save();
                echo "<script>alert('Votre manga a bien été mis à jour')</script>";
            }
        }
        
        $view = new View("manga", "back");
        $view->assign("manga", $manga);

        $manga_data = $manga->getMangas();        
        $view->assign("manga_data", $manga_data);
    }

    public function deleteManga()
    {
        $manga = new Manga();
        if(!empty($_POST['manga_id'])){
			$manga_Id = $_POST['manga_id'];
            $manga->deleteManga($manga_Id);
        }
    }

    public function editManga()
    {
        $manga = new Manga();
        $view = new View("edit-manga", "back");
        $view->assign("manga", $manga);
        
        if(!empty($_POST)){
			$manga->setId($_GET["id"]);
			$manga->setTypeManga(htmlspecialchars($_POST["type"]));
            $manga->setTitleManga(htmlspecialchars($_POST["title"]));
            $manga->setDescriptionManga(htmlspecialchars($_POST["description"]));
            $manga->setImageManga(htmlspecialchars($_POST["image"]));
            $manga->setReleaseDateManga(htmlspecialchars($_POST["releaseDate"]));
            $manga->setAuthorManga(htmlspecialchars($_POST["author"]));
            $manga->setStatusManga(htmlspecialchars($_POST["status"]));
            $manga->setCategoryManga(htmlspecialchars($_POST["category"]));
            $manga->setNbTomesManga(htmlspecialchars($_POST["nbTomes"]));
            $manga->setNbChaptersManga(htmlspecialchars($_POST["nbChapters"]));
            $manga->setNbEpisodesManga(htmlspecialchars($_POST["nbEpisodes"]));
            $manga->setDiffusionManga(htmlspecialchars($_POST["diffusion"]));
            $manga->setNbSeasonsManga(htmlspecialchars($_POST["nbSeasons"]));
            $manga->setProductionStudioManga(htmlspecialchars($_POST["productionStudio"]));
            $manga->save();
            echo "<script>alert('Votre manga a bien été mis à jour')</script>";
		}
    }


    public function  recuperer_mdp()
    {
        $user = new UserModel();
        $errors = [];
        if(!empty($_POST)) {
            $result = PasswordReset::checkFormPasswordReset($user->getPasswordResetForm(), $_POST);
            $errors = $result;
        }
        $view = new View("mot_passe_oublier");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }

    public function  initialiser_mdp()
    {
        $user = new UserModel();
        $mdp = new PasswordModel();
        $errors = [];
        $token  = $_GET['token'];
        $email  = $_GET['email'];
        if (isset($token)){

            $result = PasswordReset::checkFormPasswordInit($user->getPasswordInitForm(), $_POST);
            if ($result[0]===1){
                echo "<script>alert('Vous avez depassé 1h pour reinitialiser votre Mot de passe')</script>";
                //header('location:'.LOGIN_VIEW_ROUTE);
            }
            if ($result[0]===0){
                echo "<script>alert('Vous n\'avez effectuer aucun demande d\'initialisation du mot de passe')</script>";
                //header('location:'.LOGIN_VIEW_ROUTE);
            }
            else{
                if(!empty($_POST)) {
                    $password = $_POST["password"];
                    $password_c = $_POST["confirm_password"];
                    if ($password == $password_c){
                        //$user->setPassword($password);
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $user->NewPassword($password,$email);
                        $mdp->UpdateStatut(1,$email);
                        $errors[] = "<br>Votre mot de passe est modefié<br><a href='login'>Se connecter</a>";
                    }
                    else{
                        $errors[] = "<br>Verifier que vous avez mis le meme password dans les deux champs";
                    }

                }
                $view = new View("mot_passe_initier");
                $view->assign("user", $user);
                $view->assign("errors", $errors);
            }
        }
        else{
            echo "<script>alert('Vous n\'avez effectuer aucun demande d\'initialisation du mot de passe')</script>";
        }
    }


}
