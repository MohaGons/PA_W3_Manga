
<form action="" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="10000"
		data-name="Manga paiement"
		data-description="Pairment Evenement Manga"
		data-image=""
		data-currency="eur"
		data-email=""
            >
	</script>

</form>