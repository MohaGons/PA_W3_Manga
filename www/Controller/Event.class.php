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

            $result = Verificator::checkFormParam($event->getEventFormRegister(), $_POST);

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

        $view = new View("event", "back");
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
        $event_data = $event->getEvent($_GET["id"]);

        if (!empty($_POST)) {
            $result = Verificator::checkFormParam($event->getEventEditFormRegister($event_data), $_POST);

            if (empty($result)) {
                $event->setId($_GET["id"]);
                if (!empty($_POST["name"])) {
                    $event->setName(htmlspecialchars($_POST["name"]));
                }
                if (!empty($_POST["description"])) {
                    $event->setDescription(htmlspecialchars($_POST["description"]));
                }
                if (!empty($_POST["price"])) {
                    $event->setDate(htmlspecialchars($_POST["price"]));
                }
                if (!empty($_POST["date"])) {
                    $event->setPrice(htmlspecialchars($_POST["date"]));
                }
                if (!empty($_POST["photo"])) {
                    $event->setPhoto(htmlspecialchars($_POST["photo"]));
                }
                $event->save();
                header('Location: ./event');
            } else {
                $errors = $result;
            }
        }

        $view->assign("event_data", $event_data);
    }
}
