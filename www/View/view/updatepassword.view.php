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
