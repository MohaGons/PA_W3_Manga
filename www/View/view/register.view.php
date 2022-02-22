<h1>S'inscrire</h1>


<?php $this->includePartial("form", $user->getRegisterForm());?>

<?php $this->includePartial("captcha", null);?>



<?php $this->includePartial("form", $user->getLoginForm());?>

