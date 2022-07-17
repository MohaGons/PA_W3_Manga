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

    public static function delete($id, $page, $title)
    {
        $pageModel = new PageModel();
        $connectionPDO = new ConnectionPDO();

        $title_lower = strtolower(str_replace(" ", "-", $title));

        $pageModel->delete();
        $pageModel->where("id", $id, "=");
        $req = $connectionPDO->pdo->prepare($pageModel->getQuery());
        $req->execute();

        $content  = file_get_contents('routes.yml');
        switch ($page) {
            case "event":

                // remove route
                $search = $title_lower . ': ';
                $lines = file('routes.yml');
                $line_number = false;

                while (list($key, $line) = each($lines) and !$line_number) {
                $line_number = (strpos($line, $search) !== FALSE) ? $key + 1 : $line_number;
                }

                $delete_from_line= $line_number - 1;
                $delete_to_line= $line_number + 6;
                $filename="routes.yml";
                
                exec('sed -i.bak ' . $delete_from_line . ',' . $delete_to_line . 'd ' . $filename);

                // remove text from sidebar_front
                $lines  = file('View/Template/sidebar_front.tpl.php');
                $search = '<li><a href="/' . $title_lower . '">' . $title . '</a></li>';

                $result = '';
                foreach($lines as $line) {
                    if(stripos($line, $search) === false) {
                        $result .= $line;
                    }
                }
                file_put_contents('View/Template/sidebar_front.tpl.php', $result);

                // remove file
                unlink('View/view/front-event.view.php');
                break;
            case "forum":

                // remove route
                $search = $title_lower . ': ';
                $lines = file('routes.yml');
                $line_number = false;

                while (list($key, $line) = each($lines) and !$line_number) {
                $line_number = (strpos($line, $search) !== FALSE) ? $key + 1 : $line_number;
                }

                $delete_from_line= $line_number - 1;
                $delete_to_line= $line_number + 6;
                $filename="routes.yml";
                
                exec('sed -i.bak ' . $delete_from_line . ',' . $delete_to_line . 'd ' . $filename);

                // remove text from sidebar_front
                $lines  = file('View/Template/sidebar_front.tpl.php');
                $search = '<li><a href="/' . $title_lower . '">' . $title . '</a></li>';

                $result = '';
                foreach($lines as $line) {
                    if(stripos($line, $search) === false) {
                        $result .= $line;
                    }
                }
                file_put_contents('View/Template/sidebar_front.tpl.php', $result);

                // remove file
                unlink('View/view/front-forum.view.php');
                break;
            case "manga":

                // remove route
                $search = $title_lower . ': ';
                $lines = file('routes.yml');
                $line_number = false;

                while (list($key, $line) = each($lines) and !$line_number) {
                $line_number = (strpos($line, $search) !== FALSE) ? $key + 1 : $line_number;
                }

                $delete_from_line= $line_number - 1;
                $delete_to_line= $line_number + 6;
                $filename="routes.yml";
                
                exec('sed -i.bak ' . $delete_from_line . ',' . $delete_to_line . 'd ' . $filename);

                // remove text from sidebar_front
                $lines  = file('View/Template/sidebar_front.tpl.php');
                $search = '<li><a href="/' . $title_lower . '">' . $title . '</a></li>';

                $result = '';
                foreach($lines as $line) {
                    if(stripos($line, $search) === false) {
                        $result .= $line;
                    }
                }
                file_put_contents('View/Template/sidebar_front.tpl.php', $result);

                // remove file
                unlink('View/view/front-manga.view.php');
                break;
            
        }

        return header("Location: /admin/page");
    }



}
