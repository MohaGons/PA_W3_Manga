<?php

namespace App\Controller\Admin;

use App\Core\Security as Security;
use App\Core\Session as Session;
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

    public function create()
    {
        $category = new CategoryModel();
        $errors = [];

        if (!empty($_POST)) {

            $result = Verificator::checkForm($category->getCategoryForm(), $_POST);

            if (empty($result)) {
                if (!empty($_POST["name"])) {
                    $category->setNameCategory(htmlspecialchars($_POST["name"]));
                }
                $category->setDescriptionCategory(htmlspecialchars($_POST["description"]));
                $category->setCreatedAt(date("Y-m-d H:i:s"));
                $category->setUpdatedAt(date("Y-m-d H:i:s"));
                $category->setUserId(Session::get('id'));
                $category->save();
                echo "<script>alert('Votre catégorie a bien été enregistrée')</script>";
                header("Location: /admin/category");
            } else {
                $errors = $result;
            }
        }

        $view = new View("admin/category_create", "back");
        $view->assign("category", $category);
        $view->assign("errors", $errors);
    }

    public function edit($params)
    {

        $id = $params[0];

        if (!empty($id) && is_numeric($id))
        {
            $category = new CategoryModel();
            $categorie_data = CategoryRepository::findById($id);
            $errors = [];

            if (!empty($_POST)) {

                $result = Verificator::checkForm($category->editCategoryForm($categorie_data), $_POST);
                if (empty($result)) {
                    $category->setId($id);
                    if (!empty($_POST["editName"])) {
                        $category->setNameCategory(htmlspecialchars($_POST["editName"]));
                    }
                    $category->setDescriptionCategory(htmlspecialchars($_POST["editDescription"]));
                    $category->setCreatedAt($categorie_data[0]["createdAt"]);
                    $category->setUpdatedAt(date("Y-m-d H:i:s"));
                    $category->setUserId(Session::get('id'));
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
        else {
            Security::returnHttpResponseCode(404);
        }

    }

    public function delete($params)
    {
        $id = $params[0];

        if (!empty($id) && is_numeric($id))
        {
            $categorie_delete = CategoryRepository::delete($id);

            if ($categorie_delete == true) {
                header('Location: /admin/category');
            }
        }
        else {
            Security::returnHttpResponseCode(404);
        }
    }
}
