<?php

namespace App\Controller;

use App\Core\Mailer;
use App\Core\Security;
use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\PasswordReset;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Password as PasswordModel;
use App\Model\Category;
use App\Core\Session as Session;
use App\Repository\User as UserRepository;
use App\Repository\Password as PasswordRepository;



class User
{

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

    public function recuperer_mdp()
    {
        if (!empty(Session::get("role")))
        {
            switch (Session::get("role")){
                case "Abonne":
                    header('location:'.HOME_ROUTE);
                    break;
                default:
                    header('location:'.ADMIN_HOME_ROUTE);
                    break;
            }
        }
        else {
            $user = new UserModel();
            $password = new PasswordModel();
            $errors = [];

            if (!empty($_POST)) {
                $result = Verificator::checkForm($user->getPasswordResetForm(), $_POST);

                if (empty($result)) {
                    $userEmail = UserRepository::findByEmail($_POST["email"]);
                    if (!empty($userEmail)){
                        $token = substr(str_shuffle(bin2hex(random_bytes(128)  )), 0, 255);
                        $expiresAt = date("Y-m-d H:i:s", strtotime('+1 hours'));
                        $password->setEmail($_POST["email"]);
                        $password->setToken($token);
                        $password->setStatut(0);
                        $password->setExpiresAt($expiresAt);
                        $password->setCreatedAt(date("Y-m-d H:i:s"));
                        $password->save();

                        $destinataire = $_POST['email'];
                        $name = '';
                        $lastname = '';
                        $subject = 'Reinitialisation mot de passe';
                        $body ="Bonjour,<br>Cliquer sur le lien pour modifier votre mot de passe : <a href='".$_SERVER['HTTP_HOST']."/initialiser_mdp/".$_POST["email"]."/".$token."'>Initialiser mot de passe</a><br><br>Le lien est disponible pendant une heure. ";

                        if(Mailer::sendMail($destinataire, $name, $lastname, $subject, $body)){
                            $errors[] = "Un email a ete envoyé a l'adresse : <strong>".$_POST["email"]."</strong><br>Le lien de recuperation de mot de passe est valide pour 1h";
                        }

                    }
                    else{
                        $errors[] = "<br>Votre Email n'existe pas ";
                    }
                }
                else{
                    $errors = $result;
                }

            }
            $view = new View("mot_passe_oublier");
            $view->assign("user", $user);
            $view->assign("errors", $errors);
        }
    }

    public function initialiser_mdp($params)
    {
        if (!empty(Session::get("role")))
        {
            switch (Session::get("role")){
                case "Abonne":
                    header('location:'.HOME_ROUTE);
                    break;
                default:
                    header('location:'.ADMIN_HOME_ROUTE);
                    break;
            }
        }
        else {
            $email  = $params[0];
            $token  = $params[1];

            if (!empty($token) && !empty($email)) {
                $email = htmlspecialchars($email);
                $token = htmlspecialchars($token);
                $user = new UserModel();
                $password = new PasswordModel();

                $passwordReset = PasswordRepository::findByEmailAndToken($email, $token);


                if (!empty($passwordReset) && $passwordReset["statut"] == 0 && $passwordReset["expiresAt"] > date("Y-m-d H:i:s"))
                {
                    $errors = [];
                    if (!empty($_POST)) {
                        $result = Verificator::checkForm($user->getPasswordInitForm(), $_POST);


                        if (empty($result)) {
                            $userId = UserRepository::findByEmail($email);
                            $user->setId($userId["id"]);
                            $user->setPassword($_POST["password"]);
                            if ($user->save()) {
                                $password->setId($passwordReset["id"]);
                                $password->setStatut(1);

                                if ($password->save()) {
                                    header('location:'.LOGIN_VIEW_ROUTE);
                                }
                                else {
                                    $errors[] = "<br>La modification a échoué.";
                                }
                            }
                            else {
                                $errors[] = "<br>La modification a échoué.";
                            }
                        }
                    }
                    $view = new View("mot_passe_initier");
                    $view->assign("user", $user);
                    $view->assign("errors", $errors);
                }
                else{
                    Security::returnHttpResponseCode(404);
                }
            } else {
                Security::returnHttpResponseCode(404);
            }
        }
    }

    public function updatemdp()
    {
        $user = new UserModel();
        $mdp = new PasswordModel();
        $session = new Session();
        $errors = [];
        $email  = $_GET['email'];
        $Session_email = $session->get('email');
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
