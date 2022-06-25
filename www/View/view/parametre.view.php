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
<form action="/media?dossier=Avatars&action=update&selected" method="POST" enctype="multipart/form-data">
    <input type="submit" value="Choisir avatar dans les medias" name="upload_media">
</form>

<br><br><hr><br>
<br><br><button class="button"><a href="deletecompte?email=<?= $data['email'] ?>">Supprimer mon compte</a></button>
<br><br><button class="button"><a href="updatepassword?email=<?= $data['email'] ?>">Modifier mot de passe</a></button>
<br><br><hr><br>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <label for="add-button-color">Couleur des boutons d'ajout:</label>
        <input type="color" id="add-button-color" name="add-button-color" value="">
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <label for="delete-button-color">Couleur des boutons de suppréssion:</label>
        <input type="color" id="delete-button-color" name="delete-button-color" value="">
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <label for="button-color">Couleur des boutons:</label>
        <input type="color" id="button-color" name="button-color" value="">
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <label for="background-color">Couleur de l'arrière font:</label>
        <input type="color" id="background-color" name="background-color" value="">
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <label for="h1-color">Couleur des titres:</label>
        <input type="color" id="h1-color" name="h1-color" value="">
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <select id="font">
            <option value="default">-- Polices --</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Song-Myung">Song Myung</option>
            <option value="Roboto">Roboto</option>
        </select>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <button class="button" id="reset-button">Ré-initialiser</button>
    </div>
</div>

<script>
    // button control-add color
    $("#add-button-color").change(function () {
        localStorage.buttonAdd = $("#add-button-color").val();
        $(this).val(localStorage.buttonAdd);
    });
    $("#add-button-color").val(localStorage.buttonAdd);

    // button control-delete color
    $("#delete-button-color").change(function () {
        localStorage.buttonDelete = $("#delete-button-color").val();
        $(this).val(localStorage.buttonDelete);
    });
    $("#delete-button-color").val(localStorage.buttonDelete);

    // button color
    $("#button-color").change(function () {
        localStorage.button = $("#button-color").val();
        $(this).val(localStorage.button);
    });
    $("#button-color").val(localStorage.button);
    $('.button').css('background-color', localStorage.button);

    // body bg
    $("#background-color").change(function () {
        localStorage.background = $("#background-color").val();
        $('body').css('background', localStorage.background);
    });
    $("#background-color").val(localStorage.background);
    $('body').css('background', localStorage.background);

    // body bg
    $("#h1-color").change(function () {
        localStorage.h1Color = $("#h1-color").val();
        $('h1').css('color', localStorage.h1Color);
    });
    $("#h1-color").val(localStorage.h1Color);
    $('h1').css('color', localStorage.h1Color);

    // font family
    $("#font").change(function () {
        localStorage.font = $("#font").val();
        $("*").css("font-family", localStorage.font);
    });
    $("#font").val(localStorage.font);
    $("*").css("font-family", localStorage.font);

    // Reset values
    $("#reset-button").click(function () {
        localStorage.clear();
        window.location.replace("/parametre");
    });

</script>

