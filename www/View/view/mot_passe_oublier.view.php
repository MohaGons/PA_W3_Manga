<div class="center-form">
    <h1>Récuperer Mot de passe </h1>
    <div class="col-lg-4">
        <div class="card card--login">
            <h2>Email</h2>
            <?php $this->includePartial("form", $user->getPasswordResetForm());?>
            <?php if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error. "<br>";
                }
            }?>
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