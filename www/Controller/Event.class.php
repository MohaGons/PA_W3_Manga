<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Event as EventModel;

class Event
{

    public function EventRegister()
    {
        $event = new EventModel();
        $errors = [];
        echo "<script>alert('L'évènement')</script>";
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

        $view = new View("eventRegister");
        $view->assign("event", $event);
        $view->assign("errors", $errors);
    }
}
