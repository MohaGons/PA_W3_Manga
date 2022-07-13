<?php

namespace App\Controller\Admin;

use App\Model\User as UserModel;
use App\Model\Role as RoleModel;
use App\Core\View;
use App\Core\Verificator;
use MongoDB\BSON\Decimal128;

class Main
{

    public function home()
    {
        $view = new View("admin/home", "back");
    }


}
