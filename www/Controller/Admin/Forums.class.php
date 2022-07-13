<?php

namespace App\Controller\Admin;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Forum as ForumsModel;
use App\Model\Category;
use App\Repository\Forum as ForumRepository;

class Forums 
{
    public function create()
    {
        $forum = new ForumsModel();
        $category = new Category();
        $forum_repository = new ForumRepository();

        $errors = [];
        $categorie_data = $category->getCategoryNames();

        if (!empty($_POST)) {

            $result = Verificator::checkFormRegister($forum->getForumForm($categorie_data), $_POST);

            if (empty($result)) {
                if (!empty($_POST["title"])) {
                    $forum->setTitleForum(htmlspecialchars($_POST["title"]));
                }
                if (!empty($_POST["description"])) {
                    $forum->setDescriptionForum(htmlspecialchars($_POST["description"]));
                }
                if (!empty($_POST["categories"])) {
                    $forum->setCategoryId($_POST["categories"]);
                }
                $forum->setUserId(1);
                $forum->save();
                echo "<script>alert('Votre forum a bien été mis à jour')</script>";
            } else {
                $errors = $result;
            }
        }

        $view = new View("admin/forums_index", "back");
        $view->assign("forum", $forum);
        $view->assign("errors", $errors);

        $view->assign("categorie_data", $categorie_data);

        $forums_data = $forum_repository->all();
        $view->assign("forums_data", $forums_data);
    }

    public function delete()
    {
        $forum = new ForumsModel();
        if (!empty($_POST['forum_id'])) {
            $forum_Id = $_POST['forum_id'];
            $forum->deleteForum($forum_Id);
        }
    }

    public function edit($params)
    {
        $id = $params[1];

        if (!empty($id) && is_numeric($id)) {
            $forum = new ForumsModel();
            $category = new Category();

            $view = new View("admin/forum_edit", "back");
            $view->assign("forum", $forum);
            $categorie_data = $category->getCategoryNames();
            $forum_data = ForumRepository::findById($id);
            $errors = [];

            if (!empty($_POST)) {

                $result = Verificator::checkFormRegister($forum->editParamForum($forum_data, $categorie_data), $_POST);

                if (empty($result)) {
                    $forum->setId($_GET["id"]);
                    if (!empty($_POST["editTitle"])) {
                        $forum->setTitleForum(htmlspecialchars($_POST["editTitle"]));
                    }
                    if (!empty($_POST["editDescription"])) {
                        $forum->setDescriptionForum(htmlspecialchars($_POST["editDescription"]));
                    }
                    if (!empty($_POST["categories"])) {
                        $forum->setCategoryId($_POST["categories"]);
                    }
                    $forum->setUserId(1);
                    $forum->save();
                    //echo "<script>alert('Votre forum a bien été mis à jour')</script>";
                    header('Location: ./forums');
                } else {
                    $errors = $result;
                }
            }
        }

        $view->assign("categorie_data", $categorie_data);
        $view->assign("errors", $errors);
        $view->assign("forum_data", $forum_data);
    }

    public function forum()
    {
        $forum = new ForumsModel();
        $view = new View("admin/forums_index", "front");
        $view->assign("forum", $forum);

        $forum_data = $forum->findById($_GET["id"]);
        $view->assign("forum_data", $forum_data);
    }
}