<h1>S'inscrire</h1>


<?php $this->includePartial("form", $user->getRegisterForm()); ?>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} ?>

<script>
$('.control--add').css('background-color', localStorage.buttonAdd);
$('.control--delete').css('background-color', localStorage.buttonDelete);
$('.button').css('background-color', localStorage.button);
$('body').css('background-color', localStorage.background);
$('h1').css('color', localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>
