<?php

namespace App\Controller\Admin;

use App\Model\User as UserModel;
use App\Model\Role as RoleModel;
use App\Core\View;
use App\Core\Verificator;
use MongoDB\BSON\Decimal128;
use App\Model\Category as CategoryModel;
use App\Repository\Category as CategoryRepository;

class Category
{

    public function index()
    {
        $categorie_data = CategoryRepository::all();

        $view = new View("admin/category_index", "back");

        $view->assign("categorie_data", $categorie_data);
    }

//    public function create()

    public function edit($params)
    {

        $id = $params[0];

        if (!empty($id) && is_numeric($id))
        {
            $category = new CategoryModel();
            $categorie_data = CategoryRepository::findById($id);
            $errors = [];

            if (!empty($_POST)) {

                $result = Verificator::checkFormParam($category->editCategoryForm($categorie_data), $_POST);
//                die("yugijnklmù");
                if (empty($result)) {
                    $category->setId($id);
                    $category->setNameCategory(htmlspecialchars($_POST["editName"]));
                    $category->setDescriptionCategory(htmlspecialchars($_POST["editDescription"]));
                    $category->save();
                    header('Location: /admin/category');
                } else {
                    $errors = $result;
                }
            }

            $view = new View("admin/category_edit", "back");
            $view->assign("category", $category);
            $view->assign("categorie_data", $categorie_data);
            $view->assign("errors", $errors);
        }

    }

    public function delete($params)
    {
//        die("crttyvuijokp");
        $id = $params[0];

        if (!empty($id) && is_numeric($id))
        {

            $categorie_delete = CategoryRepository::delete($id);

            if ($categorie_delete == true) {
                header('Location: /admin/category');
            }

//            die(var_dump($categorie_delete));


        }


    }

}
