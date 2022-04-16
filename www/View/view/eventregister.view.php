<h1>Créer un nouvel évènement</h1>


<?php $this->includePartial("form", $event->getEventFormRegister()); ?>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} ?>

<?php //$this->includePartial("captcha", null);
?>



<?php //$this->includePartial("form", $user->getLoginForm());
?>