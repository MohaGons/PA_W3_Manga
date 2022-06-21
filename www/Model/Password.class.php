<?php

namespace App\Model;

use App\Core\Sql;
use PDO;

class Password extends Sql
{
  public function UpdateStatut($Nb,$Email){
      $q = "UPDATE passwords SET  statut = :nb WHERE email = :email";
      $req = $this->pdo->prepare($q);
      $req->execute( ['nb'=> $Nb, 'email' => $Email] );
      $req->fetch();
  }
}