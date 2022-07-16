<?php

namespace App\Repository;

use App\Model\Page as PageModel;
use App\Core\ConnectionPDO;

class Page {

    public function all()
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

    public static function dataPage($page, $user_id)
    {
        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();

        $pageModel->select(["*"]);
        $pageModel->where("page", $page, "=");
        $pageModel->where("user_id", $user_id, "=");
        $req = $connectionPDO->pdo->prepare($pageModel->getQuery());
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public function delete($id, $page)
    {
        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();

        $pageModel->delete();
        $pageModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($pageModel->getQuery());
        $req->execute();

        $content  = file_get_contents('routes.yml');
        switch ($page) {
            case "event":
                $search = '
/event:
    controller: frontevent
    action: FrontEvent
    security: All
    params: null
';
                $content = str_replace($search, '', $content);
                file_put_contents('routes.yml', $content);
                break;
            case "forum":
                $test = [];
                $file_content = file_get_contents('routes.yml');
                $string = "/forum:";
                $content_before_string = strstr($file_content, $string, true);
                
                if (!feof($file_content)) {
                    $line = count(explode(PHP_EOL, $content_before_string));
                    $test[] = $line;
                    //die("String $string found at line number: $line");
                }
                die(var_dump($test));
                break;
            case "manga":
                $search = '
/manga:
    controller: frontmanga
    action: FrontManga
    security: All
    params: null
';
                $content = str_replace($search, '', $content);
                file_put_contents('routes.yml', $content);
                break;
            
        }

        return header("Location: /admin/page");
    }
}
