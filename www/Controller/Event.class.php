<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Event as EventModel;

class Event
{

    public function Event()
    {
        $event = new EventModel();
        $errors = [];
        if (!empty($_POST)) {

            $result = Verificator::checkEventFormRegister($event->getEventFormRegister(), $_POST);

            if (empty($result)) {
                $event->setName(htmlspecialchars($_POST["name"]));
                $event->setDescription(htmlspecialchars($_POST["description"]));
                $event->setPrice(htmlspecialchars($_POST["price"]));
                $event->setDate(htmlspecialchars($_POST["date"]));
                $event->setPhoto(htmlspecialchars($_POST["photo"]));
                $event->save();
                echo "<script>alert('L'évènement a bien été crée')</script>";
            } else {
                $errors = $result;
            }
        }



        $view = new View("event");
        $view->assign("event", $event);
        $event = $event->getEvents();
        $view->assign("event_data", $event);
        $view->assign("errors", $errors);
    }

    public function deleteEvent()
    {
        $event = new EventModel();

        if (isset($_GET['id'])) {
            $event_id = $_GET['id'];
            $event->deleteEvent($event_id);
        }
        $view = new View("deleteEvent", "back");
        $view->assign("event_id", $event);
    }

    public function editEvent()
    {
        $event = new EventModel();
        $view = new View("edit-event", "back");
        $view->assign("event", $event);

        if (!empty($_POST)) {
            $event->setName(htmlspecialchars($_POST["name"]));
            $event->setDescription(htmlspecialchars($_POST["description"]));
            $event->setPrice(htmlspecialchars($_POST["price"]));
            $event->setDate(htmlspecialchars($_POST["date"]));
            $event->setPhoto(htmlspecialchars($_POST["photo"]));
            $event->save();
            echo "<script>alert('Votre event a bien été mis à jour')</script>";
        }
        $view = new View("event");
        $view->assign("event", $event);
        $event = $event->getEvents();
        $view->assign("event_data", $event);
        $view->assign("errors", $errors);
    }
}
