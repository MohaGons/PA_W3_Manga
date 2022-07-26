<?php

namespace App\Repository;

use App\Model\Newsletter as NewsletterModel;
use App\Core\ConnectionPDO;

class Newsletter {

    public static function all($id_subject)
    {
        $newsletterModel = new NewsletterModel ();
        $connectionPDO = new ConnectionPDO();

        $newsletterModel->select(["mnga_user.email, mnga_user.lastname, mnga_user.firstname"]);
        $newsletterModel->leftJoin("mnga_user", "mnga_newsletter.id_user", "mnga_user.id");
        $newsletterModel->where("id_subject", $id_subject, "=");
        $req = $connectionPDO->pdo->prepare($newsletterModel ->getQuery());
        $req->execute();

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

}
