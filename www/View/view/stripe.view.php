
<div class="container">

<h1>Réservez votre Evenement en toute confiance, une confirmation vous sera envoyée apres le paiement</h1>
<form action="" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="<?= $_POST['prix'] ?>"
		data-name="Manga paiement"
		data-description="Pairment Evenement Manga"
		data-image=""
		data-currency="eur"
		data-email=""
            >
	</script>
</form>

</div>