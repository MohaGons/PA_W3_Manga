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

