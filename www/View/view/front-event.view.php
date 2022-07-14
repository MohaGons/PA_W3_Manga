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
<h1>Nos Evenements</h1>
<p>Retrouver ici tout nos evenements, reservez votre place en ligne </p>
<?php if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:green; text-align: center'>".$message. "</h2><br>";
    }
}?>
<div class="container">
<div class="blocs">

         <?php
         foreach ($event_data as $key => $value) { ?>
          <div class="cards">
              <article class="card">
                  <h2><?= $value['name'] ?></h2>
                  <img src="/Style/images/Evenements/<?= $value['photo'] ?>" alt="image">
                  <p><?= $value['description'] ?></p>
                  <h2><?= $value['price'] ?>€</h2>
                  <!--<form action="/stripe" method="POST">
                      <input type="text" name="prix" value="<?= $value['price'] ?>" hidden>
                      <button><a href="/stripe">Acheter</a></button>
                  </form>-->
                  <form action="" method="post">
                      <script
                              src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                              data-key="<?php echo $publishableKey?>"
                              data-amount="<?= $value['price']*100 ?>"
                              data-name="Manga paiement"
                              data-description="Pairment Evenement Manga"
                              data-image="/Style/images/Gambling-school.png"
                              data-currency="eur"
                              data-email=""
                      >
                      </script>
                      <input type="text" name="prix" value="<?= $value['price'] ?>" hidden>
                  </form>

              </article>
          </div>
         <?php
         }
         ?>
</div>
</div>