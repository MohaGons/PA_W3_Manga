<style>
    .avatar{
        width: 75px;
        height: 75px;
        border-radius: 50%;
        border: 2px solid white;
        filter: drop-shadow(0 0 8px black);
    }
    .formparam{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }

</style>

<h1>Bonjour <?= $data['gender'] ?>.<?= $data['firstname'] ?> <?= $data['lastname'] ?></h1>
<h2>Nom : MonSitedeouf</h2>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<h2 style='color:red'>".$error. "</h2><br>";
    }
}?>
<?php $this->includePartial("form", $user->getParamForm($data));?>
<br><br><hr><br>
<?php
$img =$data['avatar'];
echo "<a href='/Style/images/Avatars/$img'><img src='/Style/images/Avatars/$img' class='avatar' /></a> ";
?>
<br><br>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Changer Avatar" name="file">
</form><br>
<form action="/admin/media?dossier=Avatars" method="POST" enctype="multipart/form-data">
    <input type="submit" value="Choisir avatar dans les medias" name="upload_media">
</form>

<br><br><hr><br>
<br><br><button class="button"><a href="/deletecompte?email=<?= $data['email'] ?>">Supprimer mon compte</a></button>
<br><br><button class="button"><a href="/updatepassword?email=<?= $data['email'] ?>">Modifier mot de passe</a></button>

