<?php

namespace App\Controller\Admin;

use App\Core\Session as Session;
use App\Core\Verificator;
use App\Core\View;
use App\Model\Forum as ForumsModel;
use App\Model\Category;
use App\Repository\Forum as ForumRepository;

class Forum
{

    public function index()
    {
        $forums_data = ForumRepository::all();
        $get_category_forum = ForumRepository::getCategoryForum();
        
        $view = new View("admin/forum_index", "back");
        $view->assign("forums_data", $forums_data);
        $view->assign("get_category_forum", $get_category_forum);
    }

    public function create()
    {
        $forum = new ForumsModel();
        $category = new Category();

        $errors = [];
        $categorie_data = $category->getCategoryNames();

        if (!empty($_POST)) {

            $result = Verificator::checkForm($forum->getForumForm($categorie_data), $_POST);

            if (empty($result)) {
                if (!empty($_POST["title"])) {
                    $forum->setTitleForum(htmlspecialchars($_POST["title"]));
                }
                if (!empty($_POST["description"])) {
                    $forum->setDescriptionForum(htmlspecialchars($_POST["description"]));
                }
                $forum->setDate(date('Y-m-d'));
                if (!empty($_POST["categories"])) {
                    $forum->setCategoryId($_POST["categories"]);
                }
                $forum->setUserId(Session::get('id'));
                $forum->setCreatedAt(date("Y-m-d H:i:s"));
                $forum->save();
                echo "<script>alert('Votre forum a bien été mis à jour')</script>";
                header("Location: /admin/forum");
            } else {
                $errors = $result;
            }
        }

        $view = new View("admin/forum_create", "back");
        $view->assign("forum", $forum);
        $view->assign("errors", $errors);
        $view->assign("categorie_data", $categorie_data);
    }

    public function delete($id)
    {
        $forum_Id = $id[1];
        if (!empty($forum_Id) && is_numeric($forum_Id))
        {
            $forum_delete = ForumRepository::delete($forum_Id);
        }
    }

    public function edit($params)
    {
        $id = $params[0];

        if (!empty($id) && is_numeric($id)) {
            $forum = new ForumsModel();
            $category = new Category();

            $categorie_data = $category->getCategoryNames();
            $forum_data = ForumRepository::findById($id);
            $errors = [];

            if (!empty($_POST)) {

                $result = Verificator::checkForm($forum->editParamForum($forum_data, $categorie_data), $_POST);

                if (empty($result)) {
                    $forum->setId($id);
                    if (!empty($_POST["editTitle"])) {
                        $forum->setTitleForum(htmlspecialchars($_POST["editTitle"]));
                    }
                    if (!empty($_POST["editDescription"])) {
                        $forum->setDescriptionForum(htmlspecialchars($_POST["editDescription"]));
                    }
                    $forum->setDate(date('Y-m-d'));
                    if (!empty($_POST["categories"])) {
                        $forum->setCategoryId($_POST["categories"]);
                    }
                    $forum->setUserId(Session::get('id'));
                    $forum->setCreatedAt($forum_data[0]["createdAt"]);
                    $forum->setUpdatedAt(date("Y-m-d H:i:s"));
                    $forum->save();
                    echo "<script>alert('Votre forum a bien été mis à jour')</script>";
                    header("Location: /admin/forum");
                } else {
                    $errors = $result;
                }
            }

            $view = new View("admin/forum_edit", "back");
            $view->assign("forum", $forum);
            $view->assign("categorie_data", $categorie_data);
            $view->assign("errors", $errors);
            $view->assign("forum_data", $forum_data);
        }

    }
}