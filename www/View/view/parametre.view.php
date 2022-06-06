<h1>Bonjour <?= $data['gender'] ?>.<?= $data['firstname'] ?> <?= $data['lastname'] ?></h1>
<h2>Nom : MonSitedeouf</h2>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<h2 style='color:red'>".$error. "</h2><br>";
    }
}?>
<?php $this->includePartial("form", $user->getParamForm($data));?>
<button><a href="deletecompte?email=<?= $data['email'] ?>">Supprimer mon compte</a></button>

