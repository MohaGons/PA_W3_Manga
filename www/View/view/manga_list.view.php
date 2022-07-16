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

<h1>Liste des manga</h1>

<div class="container">
    <div class="blocs">
        <?php
        foreach ($manga_data as $key => $value) { ?>
            <div class="cards">
                <article class="card">
                    <img src="/Style/images/Mangas/<?= $value['image'] ?>" alt="image">
                    <h2><a href="manga/detail/<?= $value['id']?>"><?= $value['title'] ?></a></h2>
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