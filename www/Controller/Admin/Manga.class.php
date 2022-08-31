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
        $session = new Session();

        $errors = [];

        if(!empty($_POST) && !empty($_FILES)) {

            $data = array_merge($_POST, $_FILES);
            $result = Verificator::checkForm($manga->getCreateMangaForm(), $data);

            if (empty($result)) {
                if (!empty($_POST["type"])) {
                    $manga->setTypeManga($_POST["type"]);
                }
                if (!empty($_POST["title"])) {
                    $manga->setTitleManga(htmlspecialchars($_POST["title"]));
                }
                if (!empty($_POST["description"])) {
                    $manga->setDescriptionManga(htmlspecialchars($_POST["description"]));
                }
                //if (!empty($_POST["type"])) {
                    $manga->setImageManga(htmlspecialchars($_FILES["file"]["name"]));
                //}
                if (!empty($_POST["releaseDate"])) {
                    $manga->setReleaseDateManga(htmlspecialchars($_POST["releaseDate"]));
                }
                if (!empty($_POST["author"])) {
                    $manga->setAuthorManga(htmlspecialchars($_POST["author"]));
                }
                if (!empty($_POST["status"])) {
                    $manga->setStatusManga(htmlspecialchars($_POST["status"]));
                }
                if (!empty($_POST["category"])) {
                    $manga->setCategoryManga(htmlspecialchars($_POST["category"]));
                }
                if (!empty($_POST["nbTomes"])) {
                    $manga->setNbTomesManga($_POST["nbTomes"]);
                }
                if (!empty($_POST["nbChapters"])) {
                    $manga->setNbChaptersManga($_POST["nbChapters"]);
                }
                if (!empty($_POST["nbEpisodes"])) {
                    $manga->setNbEpisodesManga($_POST["nbEpisodes"]);
                }
                if (!empty($_POST["diffusion"])) {
                    $manga->setDiffusionManga(htmlspecialchars($_POST["diffusion"]));
                }
                if (!empty($_POST["nbSeasons"])) {
                    $manga->setNbSeasonsManga($_POST["nbSeasons"]);
                }
                if (!empty($_POST["productionStudio"])) {
                    $manga->setProductionStudioManga(htmlspecialchars($_POST["productionStudio"]));
                }
                $manga->setCreatedAt(date("Y-m-d H:i:s"));

                $manga->save();
                $manga->notify();
                $media->setMedia("Mangas", $session->get('email'),"set");

                echo "<script>alert('Votre manga a bien été mis à jour')</script>";
                header("Location: /admin/manga");
            } else {
                $errors = $result;
            }
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
            $session = new Session();

            $mangaInfos = MangaRepository::findById($id);
            $errors = [];

            if(!empty($_POST) && !empty($_FILES)) {

                $data = array_merge($_POST, $_FILES);
                $result = Verificator::checkForm($manga->getMangaForm($mangaInfos), $data);

                if (empty($result)) {
                    $manga->setId($id);
                    if (!empty($_POST["type"])) {
                        $manga->setTypeManga($_POST["type"]);
                    }
                    if (!empty($_POST["title"])) {
                        $manga->setTitleManga(htmlspecialchars($_POST["title"]));
                    }
                    if (!empty($_POST["description"])) {
                        $manga->setDescriptionManga(htmlspecialchars($_POST["description"]));
                    }
                    //if (!empty($_POST["type"])) {
                        $manga->setImageManga(htmlspecialchars($_FILES["file"]["name"]));
                    //}
                    if (!empty($_POST["releaseDate"])) {
                        $manga->setReleaseDateManga(htmlspecialchars($_POST["releaseDate"]));
                    }
                    if (!empty($_POST["author"])) {
                        $manga->setAuthorManga(htmlspecialchars($_POST["author"]));
                    }
                    if (!empty($_POST["status"])) {
                        $manga->setStatusManga(htmlspecialchars($_POST["status"]));
                    }
                    if (!empty($_POST["category"])) {
                        $manga->setCategoryManga(htmlspecialchars($_POST["category"]));
                    }
                    if (!empty($_POST["nbTomes"])) {
                        $manga->setNbTomesManga($_POST["nbTomes"]);
                    }
                    if (!empty($_POST["nbChapters"])) {
                        $manga->setNbChaptersManga($_POST["nbChapters"]);
                    }
                    if (!empty($_POST["nbEpisodes"])) {
                        $manga->setNbEpisodesManga($_POST["nbEpisodes"]);
                    }
                    if (!empty($_POST["diffusion"])) {
                        $manga->setDiffusionManga(htmlspecialchars($_POST["diffusion"]));
                    }
                    if (!empty($_POST["nbSeasons"])) {
                        $manga->setNbSeasonsManga($_POST["nbSeasons"]);
                    }
                    if (!empty($_POST["productionStudio"])) {
                        $manga->setProductionStudioManga(htmlspecialchars($_POST["productionStudio"]));
                    }
                    $manga->save();
                    $media->setMedia("Mangas", $session->get('email'),"set");
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
