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

    public function editEvent()
    {
        $event = new EventModel();
        $view = new View("edit-event", "back");
        $view->assign("event", $event);
        $errors = [];
        $event_data = $event->getEvents($_GET["id"]);

        if (!empty($_POST)) {
            $result = Verificator::checkFormParam($event->getEventEditFormRegister($event_data), $_POST);

            if (empty($result)) {
                $event->setId($_GET["id"]);
                if (!empty($_POST["editName"])) {
                    $event->setName(htmlspecialchars($_POST["editName"]));
                }
                if (!empty($_POST["editDescription"])) {
                    $event->setDescription(htmlspecialchars($_POST["editDescription"]));
                }
                if (!empty($_POST["editDate"])) {
                    $event->setDate(htmlspecialchars($_POST["editDate"]));
                }
                if (!empty($_POST["editPrice"])) {
                    $event->setPrice(htmlspecialchars($_POST["editPrice"]));
                }
                if (!empty($_POST["editPhoto"])) {
                    $event->setPhoto(htmlspecialchars($_POST["editPhoto"]));
                }
                $event->save();
                //echo "<script>alert('Votre catégorie a bien été mis à jour')</script>";
                header('Location: ./event');
            } else {
                $errors = $result;
            }
        }
    }
}
