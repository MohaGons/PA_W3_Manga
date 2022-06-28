<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Manga as ModelManga;

class Manga 
{

    public function manga()
    {
        $manga = new ModelManga();

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
        
        $view = new View("manga", "back");
        $view->assign("manga", $manga);

        $manga_data = $manga->getMangas();
        $view->assign("manga_data", $manga_data);
    }

    public function deleteManga()
    {
        $manga = new ModelManga();
        if(!empty($_POST['manga_id'])){
			$manga_Id = $_POST['manga_id'];
            $manga->deleteManga($manga_Id);
        }
    }

    public function editManga()
    {
        $manga = new ModelManga();
        $view = new View("edit-manga", "back");
        $view->assign("manga", $manga);
        
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
    }

}
