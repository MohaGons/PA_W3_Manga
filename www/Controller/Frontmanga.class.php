<?php

namespace App\Controller;

use App\Core\Session as Session;
use App\Core\Verificator;
use App\Core\View;
use App\Model\Manga as MangaModel;
use App\Repository\Manga as MangaRepository;
use App\Repository\Page as PageRepository;

class Frontmanga 
{
    public function FrontManga()
    {
        $manga_data = MangaRepository::all();
        
        $page_data = PageRepository::dataPage("manga", Session::get('id'));
        $view = new View("front-manga");
        $view->assign("manga_data", $manga_data);
        $view->assign("page_data", $page_data);
    }

    public function detail($id)
    {   
        $manga_Id = $id[0];

        $manga = new MangaModel();
        $page_data = PageRepository::dataPage("manga", Session::get('id'));
        $manga_data = MangaRepository::findById($manga_Id);
        $view = new View("manga_detail", "front");
        $view->assign("manga", $manga);
        $view->assign("manga_data", $manga_data);
        $view->assign("page_data", $page_data);
    }
}