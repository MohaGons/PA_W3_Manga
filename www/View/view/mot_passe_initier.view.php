<div class="center-form">
    <h1>Initialiser Mot de passe </h1>
    <div class="col-lg-4">
        <div class="card card--login">
            <h2>Nouveau mot de passe</h2>
            <?php $this->includePartial("form", $user->getPasswordInitForm());?>
            <?php if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error. "<br>";
                }
            }?>
        </div>
    </div>
</div>

