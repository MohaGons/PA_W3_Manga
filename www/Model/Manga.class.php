<?php
namespace App\Model;

use App\Core\MysqlBuilder;
use App\Core\Session as Session;
use App\Core\SplSubject;
use App\Repository\Newsletter as NewsletterRepository;
use App\Model\User;

class Manga extends MysqlBuilder implements SplSubject
{
    
    protected $id = null;   
    protected $type = null;
    protected $title = null;
    protected $description = null;
    protected $image = null;
    protected $release_date = null;
    protected $author = null;
    protected $status = null;
    protected $category = null;
    protected $nb_tomes = null;
    protected $nb_chapters = null;
    protected $nb_episodes = null;
    protected $diffusion = null;
    protected $nb_seasons = null;
    protected $production_studio = null;
    protected $createdAt = null;
    protected $updatedAt = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTypeManga(): ?string
    {
        return $this->type;
    }

    public function setTypeManga(?string $type): void
    {
        $this->type = ucwords(strtolower(trim($type)));
    }

    public function getTitleManga(): ?string
    {
        return $this->title;
    }

    public function setTitleManga(?string $title): void
    {
        $this->title = ucwords(strtolower(trim($title)));
    }

    public function getDescriptionManga(): ?string
    {
        return $this->description;
    }

    public function setDescriptionManga(?string $description): void
    {
        $this->description = ucwords(strtolower(trim($description)));
    }

    public function getImageManga(): ?string
    {
        return $this->image;
    }

    public function setImageManga(?string $image): void
    {
        $this->image = $image;
    }

    public function getReleaseDateManga(): ?string
    {
        return $this->release_date;
    }

    public function setReleaseDateManga(?string $release_date): void
    {
        $this->release_date = ucwords(strtolower(trim($release_date)));
    }

    public function getAuthorManga(): ?string
    {
        return $this->author;
    }

    public function setAuthorManga(?string $author): void
    {
        $this->author = ucwords(strtolower(trim($author)));
    }

    public function getStatusManga(): ?string
    {
        return $this->status;
    }

    public function setStatusManga(?string $status): void
    {
        $this->status = ucwords(strtolower(trim($status)));
    }

    public function getCategoryManga(): ?string
    {
        return $this->category;
    }

    public function setCategoryManga(?string $category): void
    {
        $this->category = ucwords(strtolower(trim($category)));
    }

    public function getNbTomesManga(): ?int
    {
        return $this->nb_tomes;
    }

    public function setNbTomesManga(?int $nb_tomes): void
    {
        $this->nb_tomes = $nb_tomes;
    }

    public function getNbChaptersManga(): ?int
    {
        return $this->nb_chapters;
    }

    public function setNbChaptersManga(?int $nb_chapters): void
    {
        $this->nb_chapters = $nb_chapters;
    }

    public function getNbEpisodesManga(): ?int
    {
        return $this->nb_episodes;
    }

    public function setNbEpisodesManga(?int $nb_episodes): void
    {
        $this->nb_episodes = $nb_episodes;
    }

    public function getDiffusionManga(): ?string
    {
        return $this->diffusion;
    }

    public function setDiffusionManga(?string $diffusion): void
    {
        $this->diffusion = ucwords(strtolower(trim($diffusion)));
    }

    public function getNbSeasonsManga(): ?int
    {
        return $this->nb_seasons;
    }

    public function setNbSeasonsManga(?int $nb_seasons): void
    {
        $this->nb_seasons = $nb_seasons;
    }

    public function getProductionStudioManga(): ?string
    {
        return $this->production_studio;
    }

    public function setProductionStudioManga(?string $production_studio): void
    {
        $this->production_studio = ucwords(strtolower(trim($production_studio)));
    }

    /**
     * @return null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param null $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param null $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function notify(): void
    {
        $userModel = new User();
        $users = NewsletterRepository::all(NEWSLETTER_MANGA);

        foreach ($users as $user) {
            $userModel->updateNewsletter($this, $user);
        }
    }

    public function getCreateMangaForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formCreateManga",
                "class"=>"formManga",
                "enctype"=>"multipart/form-data",
            ],
            "inputs"=>[
                "token"=> [
                    "type"=> "hidden",
                    "value"=> Session::get('token'),
                ],
                "type"=>[
                    "type"=>"select",
                    "disabled"=>false,
                    "label"=>"Type: ",
                    "id"=>"typeCreateManga",
                    "option"=>[
                        "manga"=>"Manga",
                        "anime"=>"Anime",
                    ],
                    "defaultValue"=>"Manga",
                ],
                "title"=>[
                    "placeholder"=>"titre",
                    "type"=>"text",
                    "label"=>"Titre: ",
                    "id"=>"titleCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "description"=>[
                    "placeholder"=>"description",
                    "type"=>"textarea",
                    "label"=>"Description: ",
                    "id"=>"descriptionCreateManga",
                    "class"=>"formManga",
                    "rows"=>"5",
                    "cols"=>"40",
                    "text"=>null,
                    "required"=>true,
                ],
                "releaseDate"=>[
                    "placeholder"=>"releaseDate",
                    "type"=>"date",
                    "label"=>"Date de sortie: ",
                    "id"=>"releaseDateCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                ],
                "author"=>[
                    "placeholder"=>"auteur",
                    "type"=>"text",
                    "label"=>"Auteur: ",
                    "id"=>"authorCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "status"=>[
                    "type"=>"select",
                    "disabled"=>false,
                    "label"=>"Status: ",
                    "id"=>"statusCreateManga",
                    "option"=>[
                        "encours"=>"En cours",
                        "termine"=>"Termine",
                    ],
                    "defaultValue"=>"En cours",
                ],
                "category"=>[
                    "placeholder"=>"catégorie",
                    "type"=>"text",
                    "label"=>"Catégorie: ",
                    "id"=>"categoryCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "nbTomes"=>[
                    "placeholder"=>"nombres de tomes",
                    "type"=>"number",
                    "label"=>"Nombres de tomes: ",
                    "id"=>"nbTomesCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                ],
                "nbChapters"=>[
                    "placeholder"=>"nombres de chapitres",
                    "type"=>"number",
                    "label"=>"Nombres de chapitres: ",
                    "id"=>"nbChaptersCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                ],
                "nbEpisodes"=>[
                    "placeholder"=>"nombres d'episodes",
                    "type"=>"number",
                    "label"=>"Nombres d'épisodes: ",
                    "id"=>"nbEpisodesCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                ],
                "diffusion"=>[
                    "placeholder"=>"diffusion",
                    "type"=>"text",
                    "label"=>"Diffusion: ",
                    "id"=>"diffusionCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "nbSeasons"=>[
                    "placeholder"=>"nombres de saisons",
                    "type"=>"number",
                    "label"=>"Nombres de saisons: ",
                    "id"=>"nbSeasonsCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                ],
                "productionStudio"=>[
                    "placeholder"=>"studio de production",
                    "type"=>"text",
                    "label"=>"Studio de production: ",
                    "id"=>"productionStudioCreateManga",
                    "class"=>"formManga",
                    "value"=>null,
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "file"=>[
                    "type"=>"file",
                    "label"=>"Image: ",
                    "id"=>"imageCreateManga",
                    "class"=>"formManga",
                    "accept"=>"image/*",
                    "required"=>true,
                ]
            ]
        ];
    }

    public function getMangaForm($manga): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formManga",
                "class"=>"formManga",
                "enctype"=>"multipart/form-data",
            ],
            "inputs"=>[
                "token"=> [
                    "type"=> "hidden",
                    "value"=> Session::get('token'),
                ],
                "id"=>[
                    "type"=>"hidden",
                    "id"=>"idManga",
                    "value"=>$manga[0]["id"],
                    "required"=>true,
                ],
                "type"=>[
                    "type"=>"select",
                    "disabled"=>false,
                    "label"=>"Type: ",
                    "id"=>"typeManga",
                    "option"=>[
                        "manga"=>"Manga",
                        "anime"=>"Anime",
                    ],
                    "defaultValue"=>strtolower($manga[0]['type']),
                ],
                "title"=>[
                    "placeholder"=>"titre",
                    "type"=>"text",
                    "label"=>"Titre: ",
                    "id"=>"titleManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["title"],
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "description"=>[
                    "placeholder"=>"description",
                    "type"=>"textarea",
                    "label"=>"Description: ",
                    "id"=>"descriptionManga",
                    "class"=>"formManga",
                    "rows"=>"5",
                    "cols"=>"40",
                    "text"=>$manga[0]["description"],
                    "required"=>true,
                ],
                "releaseDate"=>[
                    "placeholder"=>"releaseDate",
                    "type"=>"date",
                    "label"=>"Date de sortie: ",
                    "id"=>"releaseDateManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["release_date"],
                    "required"=>true,
                ],
                "author"=>[
                    "placeholder"=>"auteur",
                    "type"=>"text",
                    "label"=>"Auteur: ",
                    "id"=>"authorManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["author"],
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "status"=>[
                    "type"=>"select",
                    "disabled"=>false,
                    "label"=>"Status: ",
                    "id"=>"statusManga",
                    "option"=>[
                        "encours"=>"En cours",
                        "termine"=>"Termine",
                    ],
                    "defaultValue"=>strtolower($manga[0]['status']),
                ],
                "category"=>[
                    "placeholder"=>"catégorie",
                    "type"=>"text",
                    "label"=>"Catégorie: ",
                    "id"=>"categoryManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["category"],
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "nbTomes"=>[
                    "placeholder"=>"nombres de tomes",
                    "type"=>"number",
                    "label"=>"Nombres de tomes: ",
                    "id"=>"nbTomesManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["nb_tomes"],
                    "required"=>true,
                ],
                "nbChapters"=>[
                    "placeholder"=>"nombres de chapitres",
                    "type"=>"number",
                    "label"=>"Nombres de chapitres: ",
                    "id"=>"nbChaptersManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["nb_chapters"],
                    "required"=>true,
                ],
                "nbEpisodes"=>[
                    "placeholder"=>"nombres d'episodes",
                    "type"=>"number",
                    "label"=>"Nombres d'épisodes: ",
                    "id"=>"nbEpisodesManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["nb_episodes"],
                    "required"=>true,
                ],
                "diffusion"=>[
                    "placeholder"=>"diffusion",
                    "type"=>"text",
                    "label"=>"Diffusion: ",
                    "id"=>"diffusionManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["diffusion"],
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "nbSeasons"=>[
                    "placeholder"=>"nombres de saisons",
                    "type"=>"number",
                    "label"=>"Nombres de saisons: ",
                    "id"=>"nbSeasonsManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["nb_seasons"],
                    "required"=>true,
                ],
                "productionStudio"=>[
                    "placeholder"=>"studio de production",
                    "type"=>"text",
                    "label"=>"Studio de production: ",
                    "id"=>"productionStudioManga",
                    "class"=>"formManga",
                    "value"=>$manga[0]["production_studio"],
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "file"=>[
                    "label"=>"image",
                    "type"=>"file",
                    "label"=>"Image: ",
                    "id"=>"imageManga",
                    "class"=>"formManga",
                    "required"=>true,
                    "accept"=>"image/*",
                ]
            ]
        ];
    }

}
