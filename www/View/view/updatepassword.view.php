<style>
    .formparam{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }

</style>
<h1>Modifier votre mot de passe</h1>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<h2 style='color:red'>".$error. "</h2><br>";
    }
}?>
<?php $this->includePartial("form", $user->getUpdatePwdForm());?>

<script>
$('.control--add').css('background-color', localStorage.buttonAdd);
$('.control--delete').css('background-color', localStorage.buttonDelete);
$('.button').css('background-color', localStorage.button);
$('body').css('background-color', localStorage.background);
$('h1').css('color', localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>
