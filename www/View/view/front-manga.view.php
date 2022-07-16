<style>
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
                            echo "Nombre d'épisodes: " . $value["nb_episodes"];
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