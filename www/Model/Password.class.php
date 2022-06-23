<?php

namespace App\Model;

use App\Core\MysqlBuilder;
use PDO;

class Password extends MysqlBuilder
{

  public function UpdateStatut($Nb,$Email){
      $q = "UPDATE passwords SET  statut = :nb WHERE email = :email";
      $req = $this->pdo->prepare($q);
      $req->execute( ['nb'=> $Nb, 'email' => $Email] );
      $req->fetch();
  }

}
