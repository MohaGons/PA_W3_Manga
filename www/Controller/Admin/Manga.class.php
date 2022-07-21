<?php

namespace App\Controller\Admin;

use App\Core\Security as Security;
use App\Core\Session as Session;
use App\Core\Verificator;
use App\Core\View;
use App\Model\Manga as ModelManga;
use App\Repository\Manga as MangaRepository;
use App\Model\Media as MediaModel;

class Manga
{

    public function index()
    {
        $manga = MangaRepository::all();
        
        $view = new View("admin/manga_index", "back");
        $view->assign("manga", $manga);
    }

    public function create()
    {

        $manga = new ModelManga();
        $media = new MediaModel();

        $errors = [];

        if(!empty($_POST) && !empty($_FILES)) {

            $data = array_merge($_POST, $_FILES);
            $result = Verificator::checkForm($manga->getCreateMangaForm(), $data);

            if (empty($result)) {
                $manga->setTypeManga(htmlspecialchars($_POST["type"]));
                $manga->setTitleManga(htmlspecialchars($_POST["title"]));
                $manga->setDescriptionManga(htmlspecialchars($_POST["description"]));
                $manga->setImageManga(htmlspecialchars($_FILES["file"]["name"]));
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
                $manga->setCreatedAt(date("Y-m-d H:i:s"));
            }

            $manga->save();
            $manga->notify();
            $media->setMedia("Mangas", Session::get('email'), "");

            echo "<script>alert('Votre manga a bien été mis à jour')</script>";
            header("Location: /admin/manga");
        }

        $view = new View("admin/manga_create", "back");
        $view->assign("errors", $errors);
        $view->assign("manga", $manga);

    }

    public function delete($id)
    {
        $manga_Id = $id[0];

        if (!empty($manga_Id) && is_numeric($manga_Id))
        {
            $manga_delete = MangaRepository::delete($manga_Id);
        }
        else {
            Security::returnHttpResponseCode(404);
        }
        
    }

    public function edit($params)
    {
        $id = $params[0];

        if (!empty($id) && is_numeric($id))
        {
            $manga = new ModelManga();
            $media = new MediaModel();

            $mangaInfos = MangaRepository::findById($id);
            $errors = [];

            if(!empty($_POST) && !empty($_FILES)) {

                $data = array_merge($_POST, $_FILES);
                $result = Verificator::checkForm($manga->getMangaForm($mangaInfos), $data);

                if (empty($result)) {
                    $manga->setId($id);
                    $manga->setTypeManga(htmlspecialchars($_POST["type"]));
                    $manga->setTitleManga(htmlspecialchars($_POST["title"]));
                    $manga->setDescriptionManga(htmlspecialchars($_POST["description"]));
                    $manga->setImageManga(htmlspecialchars($_FILES["file"]["name"]));
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
                    $media->setMedia("Mangas", Session::get('email'), "");
                    echo "<script>alert('Votre manga a bien été mis à jour')</script>";
                    header("Location: /admin/manga");
                } else {
                    $errors = $result;
                }

            }

            $view = new View("admin/manga_edit", "back");
            $view->assign("manga", $manga);
            $view->assign("mangaInfos", $mangaInfos);
            $view->assign("errors", $errors);

        }
        else {
            Security::returnHttpResponseCode(404);
        }

    }

}
