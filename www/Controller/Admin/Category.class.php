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
//        echo "<pre>";
//        die(var_dump($categorie_data));
//        $errors = [];
//
//        if (!empty($_POST)) {
//
//            $result = Verificator::checkFormParam($category->getCategoryForm(), $_POST);
//            if (empty($result)) {
//                if (!empty($_POST["name"])) {
//                    $category->setNameCategory(htmlspecialchars($_POST["name"]));
//                }
//                $category->setDescriptionCategory(htmlspecialchars($_POST["description"]));
//                $category->save();
//                echo "<script>alert('Votre catégorie a bien été mis à jour')</script>";
//            } else {
//                $errors = $result;
//            }
//        }

        $view = new View("admin/category_index", "back");

        $view->assign("categorie_data", $categorie_data);
    }

    public function deleteCategory()
    {
        $category = new Category();
        if (!empty($_POST['category_id'])) {
            $category_Id = $_POST['category_id'];
            $category->deleteCategory($category_Id);
        }
    }

    public function edit($params)
    {

        $id = $params[0];

        if (!empty($id) && is_numeric($id))
        {
            $category = new CategoryModel();
            $categorie_data = CategoryRepository::findById($id);
//            echo "<pre>";
//            die(var_dump($categorie_data));
            $errors = [];

            if (!empty($_POST)) {
                $result = Verificator::checkFormParam($category->editCategoryForm($categorie_data), $_POST);

                if (empty($result)) {
                    $category->setId($_GET["id"]);
                    if (!empty($_POST["editName"])) {
                        $category->setNameCategory(htmlspecialchars($_POST["editName"]));
                    }
                    $category->setDescriptionCategory(htmlspecialchars($_POST["editDescription"]));
                    $category->save();
                    header('Location: ./categorie');
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

}
