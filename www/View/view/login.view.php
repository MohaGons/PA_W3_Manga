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
