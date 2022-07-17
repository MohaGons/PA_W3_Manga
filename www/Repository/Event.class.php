<?php

namespace App\Repository;

use App\Model\Event as EventModel;
use App\Core\ConnectionPDO;

class Event {

    public static function all()
    {
        $eventModel = new EventModel();
        $connectionPDO = new ConnectionPDO();

        $eventModel->select(["*"]);
        $req = $connectionPDO->pdo->prepare($eventModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function getRecentEvent()
    {
        $eventModel = new EventModel();
        $connectionPDO = new ConnectionPDO();

        $eventModel->select(["*"]);
        $eventModel->limit(0,3);
        $req = $connectionPDO->pdo->prepare($eventModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function findById($id)
    {
        $eventModel = new EventModel();
        $connectionPDO = new ConnectionPDO();

        $eventModel->select(["*"]);
        $eventModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($eventModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function delete($id)
    {
        $eventModel = new EventModel();
        $connectionPDO = new ConnectionPDO();

        $eventModel->delete();
        $eventModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($eventModel->getQuery());
        $req->execute();

        return header("Location: /admin/event");
    }

}
