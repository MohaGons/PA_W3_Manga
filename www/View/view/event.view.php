<h1>Évènement</h1>

<?php if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:green; text-align: center'>".$message. "</h2><br>";
    }
}?>
<a href="/<?= strtolower(str_replace(" ", "-", $page_data[0]['title']))  ?>"><button class="control--delete">Retour</button></a>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col--flex">
        
       <div class="container">
            <div class="row">
                <h4><?= $event_data[0]['name'] ?></h4>
            </div>

            <div class="row card--content">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 content">
                    <h2>Description</h2>
                    <img style="object-fit: cover;width: 100%;height: 100%;max-height: 300px;" src="/Style/images/Evenements/<?= $event_data[0]['photo'] ?>" />
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
<script>
$('.control--add').css('background-color', localStorage.buttonAdd);
$('.control--delete').css('background-color', localStorage.buttonDelete);
$('.button').css('background-color', localStorage.button);
$('body').css('background-color', localStorage.background);
$('h1').css('color', localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>
