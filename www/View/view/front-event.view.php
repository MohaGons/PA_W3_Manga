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
            
                .img{
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                    max-height: 300px;
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
                        <img class="img" src="Style/images/Evenements/<?= $value['photo'] ?>" />
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
            </div><style>
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
                        <img src="https://placekitten.com/g/1000/300" />
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