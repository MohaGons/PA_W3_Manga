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

class Media
{

    public function Allmedia(){
        $user = new UserModel();
        $session = New Session();
        $media = new MediaModel();
        $messages=[];
        $medias = $media->getAllMedia($_SESSION['email']);
        if (isset($_POST['submit'])){
            $results = $media->setMedia($_POST['media'],$_SESSION['email'],"set");
        }
        if (isset($_GET['delete']) && isset($_GET['categorie'])){
            $name = $_GET['delete'];
            $categorie = $_GET['categorie'];
            $media->deteleMedia($name,$categorie);
            $messages[] ="l'image ".$name." a ete supprimé avec succues.";
        }
        $view = new View("media", "back");
        $view->assign("medias", $medias);
        if (!empty($results)){
            $view->assign("results", $results);
        }
        if (!empty($messages)){
            $view->assign("messages", $messages);
        }


    }
}