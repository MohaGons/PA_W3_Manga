<?php

namespace App\Controller\Admin;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Manga as ModelManga;
use App\Repository\Manga as MangaRepository;

class Manga
{

    public function index()
    {
        $manga = new ModelManga();
        $manga = MangaRepository::all();

        if(!empty($_POST)) {

            $result = Verificator::checkFormRegister($manga->getMangaForm(), $_POST);
            print_r($result);

            if (empty($result)) {
                $manga->setTypeManga(htmlspecialchars($_POST["type"]));
                $manga->setTitleManga(htmlspecialchars($_POST["title"]));
                $manga->setDescriptionManga(htmlspecialchars($_POST["description"]));
                $manga->setImageManga(htmlspecialchars($_POST["image"]));
                $manga->setReleaseDateManga(htmlspecialchars($_POST["releaseDate"]));
                $manga->setAuthorManga(htmlspecialchars($_POST["author"]));
                $manga->setStatusManga(htmlspecialchars($_POST["status"]));
                $manga->setCategoryManga(htmlspecialchars($_POST["category"]));
                $manga->setNbTomesManga(htmlspecialchars($_POST["nbTomes"]));
                $manga->setNbChaptersManga(htmlspecialchars($_POST["nbChapters"]));
                $manga->setNbEpisodesManga(htmlspecialchars($_POST["nbEpisodes"]));
                $manga->setDiffusionManga(htmlspecialchars($_POST["diffusion"]));
                $manga->setNbSeasonsManga(htmlspecialchars($_POST["nbSeasons"]));
                $manga->setProductionStudioManga(htmlspecialchars($_POST["productionStudio"]));
                $manga->save();
                echo "<script>alert('Votre manga a bien été mis à jour')</script>";
            }
        }
        
        $view = new View("admin/manga_index", "back");
        $view->assign("manga", $manga);

//        $manga_data = $manga->getMangas();
//        $view->assign("manga_data", $manga_data);
    }

    public function deleteManga()
    {
        $manga = new ModelManga();
        if(!empty($_POST['manga_id'])){
			$manga_Id = $_POST['manga_id'];
            $manga->deleteManga($manga_Id);
        }
    }

    public function edit($params)
    {
        $id = $params[0];

//        die("yes");


        if (!empty($id) && is_numeric($id))
        {
            $manga = new ModelManga();
            $mangaInfos = MangaRepository::findById($id);

            if(!empty($_POST)){
                $manga->setId($_GET["id"]);
                $manga->setTypeManga(htmlspecialchars($_POST["type"]));
                $manga->setTitleManga(htmlspecialchars($_POST["title"]));
                $manga->setDescriptionManga(htmlspecialchars($_POST["description"]));
                $manga->setImageManga(htmlspecialchars($_POST["image"]));
                $manga->setReleaseDateManga(htmlspecialchars($_POST["releaseDate"]));
                $manga->setAuthorManga(htmlspecialchars($_POST["author"]));
                $manga->setStatusManga(htmlspecialchars($_POST["status"]));
                $manga->setCategoryManga(htmlspecialchars($_POST["category"]));
                $manga->setNbTomesManga(htmlspecialchars($_POST["nbTomes"]));
                $manga->setNbChaptersManga(htmlspecialchars($_POST["nbChapters"]));
                $manga->setNbEpisodesManga(htmlspecialchars($_POST["nbEpisodes"]));
                $manga->setDiffusionManga(htmlspecialchars($_POST["diffusion"]));
                $manga->setNbSeasonsManga(htmlspecialchars($_POST["nbSeasons"]));
                $manga->setProductionStudioManga(htmlspecialchars($_POST["productionStudio"]));
                $manga->save();
                echo "<script>alert('Votre manga a bien été mis à jour')</script>";
            }
//
//            echo "<pre>";
//            die(var_dump($mangaInfos[0]));
            $view = new View("admin/manga_edit", "back");
            $view->assign("manga", $manga);
            $view->assign("mangaInfos", $mangaInfos);

        }
        else {
            die("ytuiop");
        }


    }

}