<?php
namespace App\Model;

use App\Core\Session as Session;
use App\Core\MysqlBuilder;

class Page extends MysqlBuilder
{

    protected $id = null;
    protected $title = null;
    protected $description = null;
    protected $page = null;
    protected $user_id = null;

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

    public function getTitlePage(): ?string
    {
        return $this->title;
    }

    public function setTitlePage(?string $title): void
    {
        $this->title = ucwords(strtolower(trim($title)));
    }

    public function getDescriptionPage(): ?string
    {
        return $this->description;
    }

    public function setDescriptionPage(?string $description): void
    {
        $this->description = ucwords(strtolower(trim($description)));
    }

    public function getSpecificPage(): ?string
    {
        return $this->page;
    }

    public function setSpecificPage($page, $title): void
    {
        $title_lower = strtolower(str_replace(" ", "-", $title));

        switch ($page) {
            case "event":
                // create route
                $content = file_get_contents('routes.yml');
                $content .= "\n\n/" . $title_lower . ': ';
                $content .= "\n  controller: frontevent";
                $content .= "\n  action: FrontEvent";
                $content .= "\n  params: null";
                file_put_contents('routes.yml', $content);

                // create view
                $fp = fopen('View/view/front-event.view.php', "a+");
                fwrite($fp, '<style>
                h1 ,p{
                    text-align: center;
                }
                .cards {
                    width: 30%;
                }
            
                .card {
                    display: flex;
                    text-align: center;
                    padding: 50px;
                }
            
                .card img {
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                }
                .blocs{
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around;
            
                }
            </style>
            <h1><?= $page_data[0]["title"] ?></h1>
            <p><?= html_entity_decode($page_data[0]["description"]) ?></p>
            
            <div class="container">
              <div class="row">
                <?php
                foreach ($event_data as $key => $value) { ?>
                <div class="col-md-4">
                  <div class="card-wrapper">
                    <div class="thumbnail-container">
                      <a href="event/detail/<?= $value["id"] ?>">
                        <img src="/Style/images/Evenements/<?= $value[\'photo\']?>" />
                      </a>
                    </div>
                    <div class="card-details-container">
                      <div class="card-title">
                        <h1><?= $value["name"] ?></h1>
                        <h2><?= $value["price"] ?>€</h2>
                      </div>
                      <div class="card-description">
                        <span class="price">
                        <?php 
                            if (strlen($value["description"]) >= 80) {
                                echo html_entity_decode(substr($value["description"], 0, 80) . "...");
                            } else {
                                echo html_entity_decode($value["description"]);
                            }
                        ?>
                        <br><br>
                        <!--
                        <form action="" method="post">
                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="<?php echo $publishableKey?>"
                                    data-amount="<?= $value["price"]*100 ?>"
                                    data-name="Manga paiement"
                                    data-description="Pairment Evenement Manga"
                                    data-image="/Style/images/Gambling-school.png"
                                    data-currency="eur"
                                    data-email=""
                            >
                            </script>
                            <input type="text" name="prix" value="<?= $value["price"] ?>" hidden>
                        </form>
                        -->
                        </span>
                      </div>
                      <div class="card-details-bottom">
                        <div class="card-options">
                            <p>
                            <?= date("F j, Y",strtotime($value["date"])) ?>
                        </p>
                        </div>
                        <div class="card-author">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                }
                ?>
              </div>
            </div>
            <script>
$(".control--add").css("background-color", localStorage.buttonAdd);
$(".control--delete").css("background-color", localStorage.buttonDelete);
$(".button").css("background-color", localStorage.button);
$("body").css("background-color", localStorage.background);
$("h1").css("color", localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>');
                fclose($fp);

                break;
            case "forum":

                // create route
                $content = file_get_contents('routes.yml');
                $content .= "\n\n/" . $title_lower . ': ';
                $content .= "\n  controller: frontforum";
                $content .= "\n  action: FrontForum";
                $content .= "\n  params: null";
                file_put_contents('routes.yml', $content);

                $fp = fopen('View/view/front-forum.view.php', "a+");
                fwrite($fp, '<style>
                h1 ,p{
                    text-align: center;
                }
                .cards {
                    width: 30%;
                }
            
                .card {
                    display: flex;
                    text-align: center;
                    padding: 50px;
                }
            
                .card img {
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                }
                .blocs{
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around;
            
                }
            </style>
            <h1><?= $page_data[0]["title"] ?></h1>
            <p><?= html_entity_decode($page_data[0]["description"]) ?></p>
            
            <div class="container">
              <div class="row">
                <?php
                foreach ($get_category_forum as $key => $value) { ?>
                <div class="col-md-4">
                  <div class="card-wrapper">
                    <div class="thumbnail-container">
                      <a href="forum/detail/<?= $value["id"] ?>">
                        <img src="/Style/images/Forums/<?= $value[\'picture\']?>" />
                      </a>
                    </div>
                    <div class="card-details-container">
                      <div class="card-title">
                        <h1><?= $value["title"] ?></h1>
                      </div>
                      <div class="card-description">
                        <span class="price">
                        <?php 
                            if (strlen($value["description"]) >= 80) {
                                echo html_entity_decode(substr($value["description"], 0, 80) . "...");
                            } else {
                                echo html_entity_decode($value["description"]);
                            }
                        ?>
                        </span>
                      </div>
                      <div class="card-details-bottom">
                        <div class="card-options">
                            <?= date("F j, Y",strtotime($value["date"])) ?>
                        </div>
                        <div class="card-author">
                          <strong><?= $value["user_firstname"]?> <?= $value["user_lastname"]?></strong>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                }
                ?>
              </div>
            </div>
            <script>
$(".control--add").css("background-color", localStorage.buttonAdd);
$(".control--delete").css("background-color", localStorage.buttonDelete);
$(".button").css("background-color", localStorage.button);
$("body").css("background-color", localStorage.background);
$("h1").css("color", localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>');
                fclose($fp);

                break;
            case "manga":

                // create route
                $content = file_get_contents('routes.yml');
                $content .= "\n\n/" . $title_lower . ': ';
                $content .= "\n  controller: frontmanga";
                $content .= "\n  action: FrontManga";
                $content .= "\n  params: null";
                file_put_contents('routes.yml', $content);

                $fp = fopen('View/view/front-manga.view.php', "a+");
                fwrite($fp, '<style>
                h1 ,p{
                    text-align: center;
                }
                .cards {
                    width: 30%;
                }
            
                .card {
                    display: flex;
                    text-align: center;
                    padding: 50px;
                }
            
                .card img {
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                }
                .blocs{
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around;
            
                }
            </style>
            <h1><?= $page_data[0]["title"] ?></h1>
            <p><?= html_entity_decode($page_data[0]["description"]) ?></p>
            
            <div class="container">
              <div class="row">
                <?php
                foreach ($manga_data as $key => $value) { ?>
                <div class="col-md-4">
                  <div class="card-wrapper">
                    <div class="thumbnail-container">
                      <a href="manga/detail/<?= $value["id"] ?>">
                      <img src="/Style/images/Mangas/<?= $value["image"] ?>" alt="image">
                      </a>
                    </div>
                    <div class="card-details-container">
                      <div class="card-title">
                        <h1><?= $value["title"] ?></h1>
                        <h2><?= $value["type"] ?></h2>
                      </div>
                      <div class="card-description">
                        <span class="price">
                        <?php 
                            if ($value["type"] == "Manga") {
                                echo "Nombre de chapitres: " . $value["nb_chapters"];
                            } else {
                            echo "Nombre d\'épisodes: " . $value["nb_episodes"];
                            }
                        ?>
                        </span>
                      </div>
                      <div class="card-details-bottom">
                        <div class="card-author">
                          <strong><?= $value["author"]?></strong>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                }
                ?>
              </div>
            </div>
            <script>
$(".control--add").css("background-color", localStorage.buttonAdd);
$(".control--delete").css("background-color", localStorage.buttonDelete);
$(".button").css("background-color", localStorage.button);
$("body").css("background-color", localStorage.background);
$("h1").css("color", localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>');
                fclose($fp);

                break;
        }

        $this->page = strtolower(trim($page));
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getPageForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formPage",
                "class"=>"formPage",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "token"=> [
                    "type"=> "hidden",
                    "value"=> Session::get('token'),
                ],
                "title"=>[
                    "placeholder"=>"Titre",
                    "type"=>"text",
                    "label"=>"Titre: ",
                    "id"=>"namePage",
                    "class"=>"formPage",
                    "value"=>"",
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "description"=>[
                    "label"=> "Description: ",
                    "type"=>"textarea",
                    "id"=>"descriptionPage",
                    "class"=>"formPage",
                    "rows"=>"5",
                    "cols"=>"33",
                    "text"=>"",
                    "required"=>true,
                    "error"=>"Votre description doit faire entre 2 et 2000 caractères",
                ],
                "page"=> [
                    "label"=> "Page: ",
                    "type"=> "select",
                    "disabled"=>false,
                    "id"=>"page",
                    "option"=>["event"=>"evenement", "forum"=>"forum", "manga"=>"manga"],
                    "defaultValue"=>"",
                ]
            ]
        ];
    }

    public function editParamPage($page_data): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"formPage",
                "class"=>"formPage",
                "submit"=>"Valider"
            ],
            "inputs"=>[
                "token"=> [
                    "type"=> "hidden",
                    "value"=> Session::get('token'),
                ],
                "title"=>[
                    "placeholder"=>"Titre",
                    "type"=>"text",
                    "label"=>"Titre: ",
                    "id"=>"namePage",
                    "class"=>"formPage",
                    "value"=>$page_data[0]['title'],
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>25,
                    "error"=>"Votre titre doit faire entre 2 et 25 caractères",
                ],
                "description"=>[
                    "label"=> "Description: ",
                    "type"=>"textarea",
                    "id"=>"editDescriptionPage",
                    "class"=>"formPage",
                    "rows"=>"5",
                    "cols"=>"33",
                    "text"=>$page_data[0]['description'],
                    "required"=>true,
                    "error"=>"Votre description doit faire entre 2 et 2000 caractères",
                ],
                "page"=> [
                    "type"=> "hidden",
                    "value"=>$page_data[0]['page']
                ]
            ]
        ];
    }

}
