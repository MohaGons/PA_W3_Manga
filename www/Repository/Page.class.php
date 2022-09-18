<?php

namespace App\Repository;

use App\Model\Page as PageModel;
use App\Core\ConnectionPDO;

class Page {

    public static function all()
    {
        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();

        $pageModel->select(["*"]);
        $req = $connectionPDO->pdo->prepare($pageModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    /* SLUG
    public function updateSlugPage($id, $title)
    {
        $slug = "";
        $slug .= $id . " ";
        $slug .= $title;
        $slug = str_replace(" ", "-", $slug);

        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();
        $colums = ["slug"=>"slug"];
        $update = [];
        foreach ($colums as $key => $value) {
            $update[] = $key . "=:" . $key;
        }
        $pageModel->update($update);
        $req = $connectionPDO->pdo->prepare($pageModel->getQuery());
        if ($req->execute(["slug"=>$slug, "id"=>$id])) {
            return true;
        } else {
            return false;
        }
    }
    */

    public static function findById($id)
    {
        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();

        $pageModel->select(["*"]);
        $pageModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($pageModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function dataPage($page)
    {
        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();

        $pageModel->select(["*"]);
        $pageModel->where("page", $page, "=");
        $req = $connectionPDO->pdo->prepare($pageModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public static function delete($id, $page, $title)
    {
        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();

        $title_lower = strtolower(str_replace(" ", "-", $title));

        $pageModel->delete();
        $pageModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($pageModel->getQuery());
        $req->execute();
        
        switch ($page) {
            case "event":
                // remove route
                $content = file_get_contents('routes.yml');
                $arrayContent = explode('/', $content);

                $output = [];
                for ($i = 1; $i < count($arrayContent); $i++) {
                    // si la chaine existe et contient un '/'
                    if (strstr($arrayContent[$i], $title_lower . ": ") == false && $arrayContent[$i] != '') {
                        // on ajoute la chaine au tableau
                        $output[] = '/' . $arrayContent[$i];
                    }
                }
                $content = file_get_contents('routes.yml');
                $content = '';
                for ($i = 0; $i < count($output); $i++) {
                    $content .= $output[$i];
                }
                file_put_contents('routes.yml', $content);

                // remove file
                unlink('View/view/front-event.view.php');
                break;
            case "forum":

                // remove route
                $content = file_get_contents('routes.yml');
                $arrayContent = explode('/', $content);

                $output = [];
                for ($i = 1; $i < count($arrayContent); $i++) {
                    // si la chaine existe et contient un '/'
                    if (strstr($arrayContent[$i], $title_lower . ": ") == false && $arrayContent[$i] != '') {
                        // on ajoute la chaine au tableau
                        $output[] = '/' . $arrayContent[$i];
                    }
                }
                $content = file_get_contents('routes.yml');
                $content = '';
                for ($i = 0; $i < count($output); $i++) {
                    $content .= $output[$i];
                }
                file_put_contents('routes.yml', $content);
                
                // remove file
                unlink('View/view/front-forum.view.php');
                break;
            case "manga":

                // remove route
                $content = file_get_contents('routes.yml');
                $arrayContent = explode('/', $content);

                $output = [];
                for ($i = 1; $i < count($arrayContent); $i++) {
                    // si la chaine existe et contient un '/'
                    if (strstr($arrayContent[$i], $title_lower . ": ") == false && $arrayContent[$i] != '') {
                        // on ajoute la chaine au tableau
                        $output[] = '/' . $arrayContent[$i];
                    }
                }
                $content = file_get_contents('routes.yml');
                $content = '';
                for ($i = 0; $i < count($output); $i++) {
                    $content .= $output[$i];
                }
                file_put_contents('routes.yml', $content);

                // remove file
                unlink('View/view/front-manga.view.php');
                break;

        }

        return header("Location: /admin/page");
    }

    public static function edit($page, $title, $new_title)
    {
        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();

        $title_lower = strtolower(str_replace(" ", "-", $title));
        $new_title_lower = strtolower(str_replace(" ", "-", $new_title));

        switch ($page) {
            case "event":
                // remove route
                $content = file_get_contents('routes.yml');
                $arrayContent = explode('/', $content);

                $output = [];
                for ($i = 1; $i < count($arrayContent); $i++) {
                    // si la chaine existe et contient un '/'
                    if (strstr($arrayContent[$i], $title_lower . ": ") == false && $arrayContent[$i] != '') {
                        // on ajoute la chaine au tableau
                        $output[] = '/' . $arrayContent[$i];
                    }
                }
                $content = file_get_contents('routes.yml');
                $content = '';
                for ($i = 0; $i < count($output); $i++) {
                    $content .= $output[$i];
                }
                file_put_contents('routes.yml', $content);

                // create route
                $content = file_get_contents('routes.yml');
                $content .= "\n\n/" . $new_title_lower . ': ';
                $content .= "\n  controller: frontevent";
                $content .= "\n  action: FrontEvent";
                $content .= "\n  params: null";
                file_put_contents('routes.yml', $content);

                break;
            case "forum":

                // remove route
                $content = file_get_contents('routes.yml');
                $arrayContent = explode('/', $content);

                $output = [];
                for ($i = 1; $i < count($arrayContent); $i++) {
                    // si la chaine existe et contient un '/'
                    if (strstr($arrayContent[$i], $title_lower . ": ") == false && $arrayContent[$i] != '') {
                        // on ajoute la chaine au tableau
                        $output[] = '/' . $arrayContent[$i];
                    }
                }
                $content = file_get_contents('routes.yml');
                $content = '';
                for ($i = 0; $i < count($output); $i++) {
                    $content .= $output[$i];
                }
                file_put_contents('routes.yml', $content);
                
                // create route
                $content = file_get_contents('routes.yml');
                $content .= "\n\n/" . $new_title_lower . ': ';
                $content .= "\n  controller: frontforum";
                $content .= "\n  action: FrontForum";
                $content .= "\n  params: null";
                file_put_contents('routes.yml', $content);

                break;
            case "manga":

                // remove route
                $content = file_get_contents('routes.yml');
                $arrayContent = explode('/', $content);

                $output = [];
                for ($i = 1; $i < count($arrayContent); $i++) {
                    // si la chaine existe et contient un '/'
                    if (strstr($arrayContent[$i], $title_lower . ": ") == false && $arrayContent[$i] != '') {
                        // on ajoute la chaine au tableau
                        $output[] = '/' . $arrayContent[$i];
                    }
                }
                $content = file_get_contents('routes.yml');
                $content = '';
                for ($i = 0; $i < count($output); $i++) {
                    $content .= $output[$i];
                }
                file_put_contents('routes.yml', $content);

                // create route
                $content = file_get_contents('routes.yml');
                $content .= "\n\n/" . $new_title_lower . ': ';
                $content .= "\n  controller: frontmanga";
                $content .= "\n  action: FrontManga";
                $content .= "\n  params: null";
                file_put_contents('routes.yml', $content);

                break;

        }

        return header("Location: /admin/page");
    }


}
