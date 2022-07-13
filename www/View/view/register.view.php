<h1>S'inscrire</h1>


<?php $this->includePartial("form", $user->getRegisterForm()); ?>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} ?>


<?php //$this->includePartial("captcha", null);
?>



<?php //$this->includePartial("form", $user->getLoginForm());
?>