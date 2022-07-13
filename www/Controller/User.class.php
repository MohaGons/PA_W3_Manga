<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\PasswordReset;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Password as PasswordModel;
use App\Model\Media as MediaModel;
use App\Model\Category;
use App\Model\Forum;
use App\Core\Mailer;
use App\Core\Session as Session;
use App\Model\Manga;
use App\Model\Event as EventModel;



class User
{

    public function login()
    {
        die("uyiojp");
        $session = new Session();
        $user = new UserModel();
        $errors = [];
        if (!empty($_POST)) {

            $result = $user->checkLogin($_POST);
            if ($result == false) {
                $errors[] = 'Vos identifiants de connexion ne correspondent à aucun compte ';
            } else {
                $session->ensureStarted();
                $session->set('email', $_POST['email']);
                $roleId = $user->getRoleByEmail($_POST['email']);
                $role = $user->getRole($roleId['role']);
                $session->set('role', $role['role']);
                header('location:' . DASHBOARD_VIEW_ROUTE);
            }
        }
        $view = new View("login");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
        /*
        if (!empty($session->get('email',''))) {
            header('location:'.DASHBOARD_VIEW_ROUTE);
        }
        */
    }

    public function logout()
    {
        $session = new Session();
        $session->delete('email');
        $session->sessionDestroy();
        header('location:' . LOGIN_VIEW_ROUTE);
    }

    public function register()
    {
        $session = new Session();
        $user = new UserModel();
        $media = new MediaModel();
        $errors = [];

        if (!empty($_POST)) {
            $result = Verificator::checkFormRegister($user->getRegisterForm(), $_POST);

            if (empty($result)) {
                $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                $user->setLastname(htmlspecialchars($_POST["lastname"]));
                $user->setEmail(htmlspecialchars($_POST["email"]));
                $user->setPassword(htmlspecialchars($_POST["password"]));
                $user->setGender(htmlspecialchars($_POST["gender"]));
                $user->setAvatar(htmlspecialchars($_FILES["file"]["name"]));
                $user->save();
                $media->setMedia("Avatars", $_POST["email"], "set");
                echo "<script>alert('Votre profil a bien été mis à jour')</script>";
                $session->ensureStarted();
                $session->set('email', $_POST['email']);
                $destinataire = $_POST["email"];
                $name = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $subject = 'Inscription MangaSite';
                $body = 'Bienvenue ' . $name . ' sur MangaSite';
                Mailer::sendMail($destinataire, $name, $lastname, $subject, $body);
                $session->ensureStarted();
                $session->set('email', $_POST['email']);
                $roleId = $user->getRoleByEmail($_POST['email']);
                $role = $user->getRole($roleId['role']);
                $session->set('role', $role['role']);
                header('location:' . DASHBOARD_VIEW_ROUTE);
            } else {
                $errors = $result;
            }
        }

        $view = new View("Register");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }

    public function parametre()
    {
        $user = new UserModel();
        $session = new Session();
        $media = new MediaModel();
        $email = $session->get('email', '');
        $lastname = $user->getLastname($email);
        $firstname = $user->getFirstname($email);
        $gender = $user->getGender($email);
        $avatar = $user->getAvatar($email);
        if (!empty($_POST)) {
            if (!empty($result)) {
                $result = Verificator::checkFormParam($user->getParamForm($data), $_POST);
            }

            if (empty($result)) {
                if (!empty($_POST["lastname"])) {
                    $lastname = $_POST["lastname"];
                    $user->updateLastname($lastname, $email);
                }
                if (!empty($_POST["firstname"])) {
                    $firstname = $_POST["firstname"];
                    $user->updateFirstname($firstname, $email);
                }
            } else {
                $errors = $result;
            }
        }
        if (isset($_POST['file'])) {
            $message = $media->setMedia("Avatars", $_SESSION['email'], "update");
            $errors = $message;
            if ($message == NULL) {
                header('Location: ./parametre');
            }
        }
        if (isset($_GET['avatar'])) {
            $nom = htmlspecialchars($_GET['avatar']);
            $media->updateAvatar($nom, $_SESSION['email']);
            $errors[] = "Votre Avatar est mise a jour avec succes";
            header('Location: ./parametre');
        }
        $view = new View("parametre", "back");
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

    public function deletecompte()
    {
        $user = new UserModel;
        $email = $_GET['email'];
        if ($email == $_SESSION['email']) {
            $user->deletecompte($email);
            if ($user == 1) {
                echo "<script>alert('Votre compte a bien été supprimer')</script>";
            } else {
                echo "<script>alert('Reessayer plus tard')</script>";
            }
        } else {
            header('location:' . LOGIN_VIEW_ROUTE);
        }
    }


    public function category()
    {
        $category = new Category();
        $errors = [];

        if (!empty($_POST)) {

            $result = Verificator::checkFormParam($category->getCategoryForm(), $_POST);
            if (empty($result)) {
                if (!empty($_POST["name"])) {
                    $category->setNameCategory(htmlspecialchars($_POST["name"]));
                }
                $category->setDescriptionCategory(htmlspecialchars($_POST["description"]));
                $category->save();
                echo "<script>alert('Votre catégorie a bien été mis à jour')</script>";
            } else {
                $errors = $result;
            }
        }

        $view = new View("category", "back");
        $view->assign("category", $category);
        $view->assign("errors", $errors);

        $categorie_data = $category->getCategories();
        $view->assign("categorie_data", $categorie_data);
    }

    public function deleteCategory()
    {
        $category = new Category();
        if (!empty($_POST['category_id'])) {
            $category_Id = $_POST['category_id'];
            $category->deleteCategory($category_Id);
        }
    }

    public function editCategory()
    {
        $category = new Category();
        $view = new View("edit-category", "back");
        $view->assign("category", $category);
        $errors = [];
        $categorie_data = $category->getCategory($_GET["id"]);

        if (!empty($_POST)) {
            $result = Verificator::checkFormParam($category->editCategoryForm($categorie_data), $_POST);

            if (empty($result)) {
                $category->setId($_GET["id"]);
                if (!empty($_POST["editName"])) {
                    $category->setNameCategory(htmlspecialchars($_POST["editName"]));
                }
                $category->setDescriptionCategory(htmlspecialchars($_POST["editDescription"]));
                $category->save();
                header('Location: ./categorie');
            } else {
                $errors = $result;
            }
        }

        $view->assign("errors", $errors);
        $view->assign("categorie_data", $categorie_data);
    }

    public function  recuperer_mdp()
    {
        $user = new UserModel();
        $errors = [];
        if (!empty($_POST)) {
            $result = PasswordReset::checkFormPasswordReset($user->getPasswordResetForm(), $_POST);
            $errors = $result;
        }
        $view = new View("mot_passe_oublier");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }

    public function initialiser_mdp()
    {
        $user = new UserModel();
        $mdp = new PasswordModel();
        $errors = [];
        $token  = $_GET['token'];
        $email  = $_GET['email'];
        if (isset($token)) {

            $result = PasswordReset::checkFormPasswordInit($user->getPasswordInitForm(), $_POST);
            if ($result[0] === 1) {
                echo "<script>alert('Vous avez depassé 1h pour reinitialiser votre Mot de passe')</script>";
                //header('location:'.LOGIN_VIEW_ROUTE);
            }
            if ($result[0] === 0) {
                echo "<script>alert('Vous n\'avez effectuer aucun demande d\'initialisation du mot de passe')</script>";
                //header('location:'.LOGIN_VIEW_ROUTE);
            } else {
                if (!empty($_POST)) {
                    $password = $_POST["password"];
                    $password_c = $_POST["confirm_password"];
                    if ($password == $password_c) {
                        //$user->setPassword($password);
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $mdp->NewPassword($password, $email);
                        $mdp->UpdateStatut(1, $email);
                        $errors[] = "<br>Votre mot de passe est modefié<br><a href='login'>Se connecter</a>";
                    } else {
                        $errors[] = "<br>Verifier que vous avez mis le meme password dans les deux champs";
                    }
                }
                $view = new View("mot_passe_initier");
                $view->assign("user", $user);
                $view->assign("errors", $errors);
            }
        } else {
            echo "<script>alert('Vous n\'avez effectuer aucun demande d\'initialisation du mot de passe')</script>";
        }
    }

    public function updatemdp()
    {
        $user = new UserModel();
        $mdp = new PasswordModel();
        $errors = [];
        $email  = $_GET['email'];
        $Session_email = $_SESSION['email'];
        if ($email == $Session_email) {
            if (!empty($_POST)) {
                $oldpassword = htmlspecialchars($_POST['oldpassword']);
                $newpassword = htmlspecialchars($_POST['password']);
                $cfmpassword = htmlspecialchars($_POST['confirm_password']);
                if ($mdp->verifiemdp($oldpassword, $email)) {
                    $result = Verificator::checkPwd($newpassword);
                    if ($result) {
                        if ($newpassword == $cfmpassword) {
                            $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
                            $mdp->NewPassword($newpassword, $email);
                            $errors[] = "Votre mot de passe est modifié avec succes";
                        } else {
                            $errors[] = "Les champs mot de passe et la confirmation ne sont pas compatible, verifier votre saisie avant de validé";
                        }
                    } else {
                        $errors[] = "Votre nouveau mot de passe doit contenir au moins majuscule, nombre, 8 characteres";
                    }
                } else {
                    $errors[] = "Verifier votre ancien mot de passe, il est pas correct";
                }
            }
        } else {
            header('location:' . LOGIN_VIEW_ROUTE);
        }
        $view = new View("updatepassword", "back");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }

    public function deleteEvent($event_Id)
    {
        $query = $this->pdo->prepare("DELETE FROM mnga_event WHERE id= :id");
        $query->bindValue(':id', $event_Id);
        $query->execute();
    }
}
