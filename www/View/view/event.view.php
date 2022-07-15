<h1>Évènement</h1>

<?php if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:green; text-align: center'>".$message. "</h2><br>";
    }
}?>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col--flex">
        
       <div class="container">
            <div class="row">
                <h4><?= $event_data[0]['name'] ?></h4>
            </div>

            <div class="row card--content">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 content">
                    <h2>Description</h2>
                    <p><?= html_entity_decode($event_data[0]['description']) ?></p>
                </div>
                <form action="" method="post">
                <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="<?php echo $publishableKey?>"
                        data-amount="<?= $event_data[0]['price']*100 ?>"
                        data-name="Manga paiement"
                        data-description="Pairment Evenement Manga"
                        data-image="/Style/images/Gambling-school.png"
                        data-currency="eur"
                        data-email=""
                >
                </script>
                <input type="text" name="prix" value="<?= $event_data[0]['price'] ?>" hidden>
            </form>
            </div>
        </div>
    </div>
</div>