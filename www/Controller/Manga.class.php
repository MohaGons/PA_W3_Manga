<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Manga as MangaModel;
use App\Repository\Manga as MangaRepository;

class Manga 
{
    public function index()
    {
        $manga_data = MangaRepository::all();
        
        $view = new View("manga_list");
        $view->assign("manga_data", $manga_data);
    }

    public function detail($id)
    {   
        $manga_Id = $id[0];

        $manga = new MangaModel();
        $manga_data = MangaRepository::findById($manga_Id);
        $view = new View("manga_detail", "front");
        $view->assign("manga", $manga);

        $view->assign("manga_data", $manga_data);
    }
}