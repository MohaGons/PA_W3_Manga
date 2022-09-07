<?php

namespace App\Controller\Admin;

use App\Core\Security as Security;
use App\Core\Verificator;
use App\Core\View;
use App\Model\Event as EventModel;
use App\Model\Media as MediaModel;
use App\Repository\Event as EventRepository;
use App\Core\Session as Session;

class Event
{

    public function index()
    {
        $event_data = EventRepository::all();
        
        $view = new View("admin/event_index", "back");
        $view->assign("event_data", $event_data);
    }

    public function create()
    {
        $event = new EventModel();
        $media = new MediaModel();
        $session = new Session();
        $errors = [];
        $errors_media = [];
        if (!empty($_POST) && !empty($_FILES)) {

            $data = array_merge($_POST, $_FILES);
            $result = Verificator::checkForm($event->getEventFormRegister(), $data);
            $errors_media = $media->setMedia("Evenements",$session->get('email'),"set");

            if (empty($result) && empty($errors_media)) {
                $event->setName(htmlspecialchars($_POST["name"]));
                $event->setDescription(htmlspecialchars($_POST["description"]));
                $event->setPrice(htmlspecialchars($_POST["price"]));
                $event->setDate(htmlspecialchars($_POST["date"]));
                $event->setPhoto(htmlspecialchars($_FILES["file"]["name"]));
                $event->setCreatedAt(date("Y-m-d H:i:s"));
                $event->save();
                echo "<script>alert('L'évènement a bien été crée')</script>";
                header("Location: /admin/event");
            } else {
                $errors = array_merge($result, $errors_media);
            }
        }

        $view = new View("admin/event_create", "back");
        $view->assign("event", $event);
        $view->assign("event_data", $event);
        $view->assign("errors", $errors);
    }

    public function delete($id)
    {
        $event_Id = $id[1];
        if (!empty($event_Id) && is_numeric($event_Id))
        {
            $event_delete = EventRepository::delete($event_Id);
        }
        else {
            Security::returnHttpResponseCode(404);
        }
    }

    public function edit($params)
    {
        $id = $params[0];
        $media = new MediaModel();
        $session = new Session();
        if (!empty($id) && is_numeric($id)) {
            $event = new EventModel();
            $errors = [];
            $errors_media = [];
            $event_data = EventRepository::findById($id);

            if(!empty($_POST) && !empty($_FILES)) {

                $data = array_merge($_POST, $_FILES);
                $result = Verificator::checkForm($event->getEventEditFormRegister($event_data), $data);
                $errors_media = $media->setEditMedia('Evenements',$session->get('email'),"" );

                if (empty($result) && empty($errors_media)) {
                    $event->setId($id);
                    if (!empty($_POST["name"])) {
                        $event->setName(htmlspecialchars($_POST["name"]));
                    }
                    if (!empty($_POST["description"])) {
                        $event->setDescription(htmlspecialchars($_POST["description"]));
                    }
                    if (!empty($_POST["price"])) {
                        $event->setPrice($_POST["price"]);
                    }
                    if (!empty($_POST["date"])) {
                        $event->setDate(htmlspecialchars($_POST["date"]));
                    }
                    if (!empty($_FILES["file"]["name"])) {
                        $event->setPhoto(htmlspecialchars($_FILES["file"]["name"]));
                    }
                    $event->save();
                    $media->updateEvenement($_FILES["file"]["name"], $_POST["name"]);
                    header('Location: /admin/event');
                } else {
                    $errors = array_merge($result, $errors_media);
                }
            }
            $view = new View("admin/event_edit", "back");
            $view->assign("event", $event);
            $view->assign("errors", $errors);
            $view->assign("event_data", $event_data);
        }
        else{
            Security::returnHttpResponseCode(404);
        }
    }


}
