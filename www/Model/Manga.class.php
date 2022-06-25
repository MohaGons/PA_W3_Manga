<?php
namespace App\Model;

use App\Core\MysqlBuilder;

class Manga extends MysqlBuilder
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
        $this->image = ucwords(strtolower(trim($image)));
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

    public function getMangaForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formManga",
                "class"=>"formManga",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "type"=>[
                    "placeholder"=>"type",
                    "type"=>"text",
                    "id"=>"typeManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "title"=>[
                    "placeholder"=>"titre",
                    "type"=>"text",
                    "id"=>"titleManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "description"=>[
                    "placeholder"=>"description",
                    "type"=>"text",
                    "id"=>"descriptionManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "releaseDate"=>[
                    "placeholder"=>"releaseDate",
                    "type"=>"date",
                    "id"=>"releaseDateManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "author"=>[
                    "placeholder"=>"auteur",
                    "type"=>"text",
                    "id"=>"authorManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "status"=>[
                    "placeholder"=>"status",
                    "type"=>"text",
                    "id"=>"statusManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "category"=>[
                    "placeholder"=>"catégorie",
                    "type"=>"text",
                    "id"=>"categoryManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "nbTomes"=>[
                    "placeholder"=>"nombres de tomes",
                    "type"=>"int",
                    "id"=>"nbTomesManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "nbChapters"=>[
                    "placeholder"=>"nombres de chapitres",
                    "type"=>"int",
                    "id"=>"nbChaptersManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "nbEpisodes"=>[
                    "placeholder"=>"nombres d'épisodes",
                    "type"=>"int",
                    "id"=>"nbEpisodesManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "diffusion"=>[
                    "placeholder"=>"diffusion",
                    "type"=>"text",
                    "id"=>"diffusionManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "nbSeasons"=>[
                    "placeholder"=>"nombres de saisons",
                    "type"=>"int",
                    "id"=>"nbSeasonsManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "productionStudio"=>[
                    "placeholder"=>"studio de production",
                    "type"=>"text",
                    "id"=>"productionStudioManga",
                    "class"=>"formManga",
                    "required"=>true,
                ],
                "image"=>[
                    "label"=>"image",
                    "type"=>"file",
                    "id"=>"imageManga",
                    "class"=>"formManga",
                    "required"=>true,
                    "accept"=>"image/*",
                ],
            ]
        ];
    }

}
