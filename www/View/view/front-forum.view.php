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
                foreach ($get_category_forum as $key => $value) { ?>
                <div class="col-md-4">
                  <div class="card-wrapper">
                    <div class="thumbnail-container">
                      <a href="forum/detail/<?= $value["id"] ?>">
                        <img src="https://placekitten.com/g/1000/300" />
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