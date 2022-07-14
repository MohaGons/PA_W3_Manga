<style>
    img {
        border: 1px solid black;
        border-radius: 4px;
        padding: 5px;
        width: 200px;
        height: 250px;
    }
    .images{
        display: flex;
        justify-content: space-between ;
        text-align: center;
        flex-wrap: wrap-reverse;
    }
    .folders{
        display: flex;
        justify-content: space-between ;
        text-align: center;
    }
</style>
<h1>Media</h1>
<?php if (!empty($results)) {
    foreach ($results as $result) {
        echo "<h2 style='color:red'>".$result. "</h2><br>";
    }
}?>
<form method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="file" value="Ajouter Media">
    <select name="media">
    <option value="">--Choisi le type de Media--</option>
    <option value="Avatars">Avatar</option>
    <option value="Articles">Article</option>
    <option value="Evenements">Evenement</option>
    <option value="Pages">Page</option>
    </select>
    <input type="submit" name="submit" value="Ajouter">
</form>
<br><br>
<div class="folders">
<a href="?dossier=Articles" ><div><div><i class="fa-solid fa-folder fa-6x"></i></div><div><label>Articles</label></div></a></div>
<a href="?dossier=Pages" ><div><div><i class="fa-solid fa-folder fa-6x"></i></div><div><label>Pages</label></div></a></div>
<a href="?dossier=Avatars" ><div><div><i class="fa-solid fa-folder fa-6x"></i></div><div><label>Avatars</label></div></a></div>
<a href="?dossier=Evenements"><div><div><i class="fa-solid fa-folder fa-6x"></i></div><div><label>Evenements</label></div></a></div></div>
<br><br><hr><br>

<?php
if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:green'>".$message. "</h2><br>";
    }
}
foreach ($medias as $media) {
    $name = $media["nom"];
    $categorie = $media["categorie"];
    ?>
    <div class="images">
<?php
    if (isset($_GET['dossier'])){
        $dossier = $_GET['dossier'];
        if ($categorie==$dossier){
            if (isset($_GET['selected'])){
                echo "<div><a href='./parametre?avatar=$name'><img src='Style/images/$categorie/$name'></a><figcaption>$name</figcaption><a href='?delete=$name&categorie=$categorie'><i class='fa-solid fa-trash'></i></a></div>";
            }
            else{
                echo "<div><a href='Style/images/$categorie/$name'><img src='Style/images/$categorie/$name'></a><figcaption>$name</figcaption><a href='?delete=$name&categorie=$categorie'><i class='fa-solid fa-trash'></i></a></div>";
            }

        }
    }
}
?>
    </div>




