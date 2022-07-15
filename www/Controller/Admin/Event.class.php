<?php

namespace App\Controller\Admin;

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
        if (!empty($_POST)) {

            $result = Verificator::checkFormParam($event->getEventFormRegister(), $_POST);

            if (empty($result)) {
                $event->setName(htmlspecialchars($_POST["name"]));
                $event->setDescription(htmlspecialchars($_POST["description"]));
                $event->setPrice(htmlspecialchars($_POST["price"]));
                $event->setDate(htmlspecialchars($_POST["date"]));
                $event->setPhoto(htmlspecialchars($_FILES["file"]["name"]));
                $event->save();
                $media->setMedia("Evenements",$session->get('email'),"set");
                echo "<script>alert('L'évènement a bien été crée')</script>";
                header("Location: /admin/event");
            } else {
                $errors = $result;
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
    }

    public function edit($params)
    {
        $id = $params[0];
        $media = new MediaModel();
        $session = new Session();
        if (!empty($id) && is_numeric($id)) {
            $event = new EventModel();
            $errors = [];
            $event_data = EventRepository::findById($id);

            if (!empty($_POST)) {
                $result = Verificator::checkFormParam($event->getEventEditFormRegister($event_data), $_POST);

                if (empty($result)) {
                    $event->setId($id);
                    if (!empty($_POST["name"])) {
                        $event->setName(htmlspecialchars($_POST["name"]));
                    }
                    if (!empty($_POST["description"])) {
                        $event->setDescription(htmlspecialchars($_POST["description"]));
                    }
                    if (!empty($_POST["price"])) {
                        $event->setPrice(htmlspecialchars($_POST["price"]));
                    }
                    if (!empty($_POST["date"])) {
                        $event->setDate(htmlspecialchars($_POST["date"]));
                    }
                    if (!empty($_FILES["file"]["name"])) {
                        $event->setPhoto(htmlspecialchars($_FILES["file"]["name"]));
                    }
                    $event->save();
                    $media->updateEvenement($_FILES["file"]["name"], $_POST["name"]);
                    $media->setMedia('Evenements',$session->get('email'),"" );
                    header('Location: /admin/event');
                } else {
                    $errors = $result;
                }
            }
            $view = new View("admin/event_edit", "back");
            $view->assign("event", $event);
            $view->assign("event_data", $event_data);
        }
    }


}