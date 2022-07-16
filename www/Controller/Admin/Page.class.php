<?php

namespace App\Controller\Admin;

use App\Core\Session as Session;
use App\Core\Verificator;
use App\Core\View;
use App\Model\Page as PageModel;
use App\Repository\Page as PageRepository;

class Page
{

    public function index()
    {
        $page_data = PageRepository::all();
        
        $view = new View("admin/page_index", "back");
        $view->assign("page_data", $page_data);
    }

    public function create()
    {
        $page = new PageModel();

        $errors = [];

        if (!empty($_POST)) {

            $result = Verificator::checkGeneralForm($page->getPageForm(), $_POST);

            if (empty($result)) {
                if (!empty($_POST["title"])) {
                    $page->setTitlePage(htmlspecialchars($_POST["title"]));
                }
                if (!empty($_POST["description"])) {
                    $page->setDescriptionPage(htmlspecialchars($_POST["description"]));
                }
                if (!empty($_POST["page"])) {
                    $page->setSpecificPage($_POST["page"], $_POST["title"]);
                }
                $page->setUserId(Session::get('id'));
                $page->save();
                echo "<script>alert('Votre page a bien été créée')</script>";
                header("Location: /admin/page");
            } else {
                $errors = $result;
            }
        }

        $view = new View("admin/page_create", "back");
        $view->assign("page", $page);
        $view->assign("errors", $errors);
    }

    public function delete($id)
    {
        $page_Id = $id[1];
        $page_data = PageRepository::findById($page_Id);
        $title = $page_data[0]["title"];
        $page = $page_data[0]["page"];
        if (!empty($page_Id) && is_numeric($page_Id))
        {
            $page_Id = PageRepository::delete($page_Id, $page, $title);
        }
    }

    public function edit($params)
    {
        $id = $params[0];

        if (!empty($id) && is_numeric($id)) {
            $page = new PageModel();
            $page_data = PageRepository::findById($id);
            $errors = [];

            if (!empty($_POST)) {

                $result = Verificator::checkFormRegister($page->editParamPage($page_data), $_POST);

                if (empty($result)) {
                    $page->setId($id);
                    if (!empty($_POST["title"])) {
                        $page->setTitlePage(htmlspecialchars($_POST["title"]));
                    }
                    if (!empty($_POST["description"])) {
                        $page->setDescriptionPage(htmlspecialchars($_POST["description"]));
                    }
                    if (!empty($_POST["page"])) {
                        $page->setSpecificPage($_POST["page"], $_POST["title"]);
                    }
                    $page->setUserId(Session::get('id'));
                    $page->save();
                    echo "<script>alert('Votre page a bien été mise à jour')</script>";
                    header("Location: /admin/page");
                } else {
                    $errors = $result;
                }
            }
            $view = new View("admin/page_edit", "back");
            $view->assign("page", $page);
            $view->assign("errors", $errors);
            $view->assign("page_data", $page_data);
        }

    }
}