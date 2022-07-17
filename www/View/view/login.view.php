<div class="login">
  <div class="form">
    <h2>Se connecter</h2>
    <?php $this->includePartial("form", $user->getLoginForm());?>
    <?php if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<br>". $error. "<br>";
        }
    }?>
    
    <br><br>
    <div class="center-form">
      <a href="recuperer_mdp">Mot de passe oublié ?</a>
      <p>Pas encore inscrit ?<a href="/register"> S'inscrire</a></p>
    </div>
  </div>
</div>

<script>
    document.getElementById("submit-button").classList.add("button-submit");
</script>

<script>
$('.control--add').css('background-color', localStorage.buttonAdd);
$('.control--delete').css('background-color', localStorage.buttonDelete);
$('.button').css('background-color', localStorage.button);
$('body').css('background-color', localStorage.background);
$('h1').css('color', localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>

