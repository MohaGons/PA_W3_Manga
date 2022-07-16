<style>
    h1 ,p{
        text-align: center;
    }
    .cards {
        width: 30%;
    }

    .card {
        display: flex;
        text-align: center;
        padding: 20px;
    }

    .card img {
        object-fit: cover;
        width: 200px;
        height: 200px;
    }
    .blocs{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;

    }
</style>

<a href="/<?= strtolower(str_replace(" ", "-", $page_data[0]['title']))  ?>"><button class="control--delete">Retour</button></a>

<?php
        foreach ($manga_data as $key => $value) { ?>
<h1><?= $value['title'] ?></h1>

<div class="container">
    <div class="blocs">
            <div class="cards">
                <article class="card">
                    <img src="/Style/images/Mangas/<?= $value['image'] ?>" alt="image">
                    <p>Type: <?= $value['type'] ?></p>
                    <p>Description: <?= $value['description'] ?></p>
                    <p>Date de sortie: <?= $value['release_date'] ?></p>
                    <p>Auteur: <?= $value['author'] ?></p>
                    <p>Status: <?= $value['status'] ?></p>
                    <p>Catégorie: <?= $value['category'] ?></p>
                    <p>Nombres de tomes: <?= $value['nb_tomes'] ?></p>
                    <p>Nombres de chapitres: <?= $value['nb_chapters'] ?></p>
                    <p>Nombres d'épisodes: <?= $value['nb_episodes'] ?></p>
                    <p>Nombres de saisons: <?= $value['nb_seasons'] ?></p>
                    <p>Diffusion: <?= $value['diffusion'] ?></p>
                    <p>Studio de production: <?= $value['production_studio'] ?></p>
                </article>
            </div>
        <?php
        }
        ?>
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