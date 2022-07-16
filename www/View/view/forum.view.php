<h1>Forum</h1>

<a href="/<?= strtolower(str_replace(" ", "-", $page_data[0]['title']))  ?>"><button class="control--delete">Retour</button></a>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col--flex">
        
       <div class="container">
            <div class="row">
                <h4><?= $forum_data[0]['title'] ?></h4>
            </div>

            <div class="row card--content">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 content">
                    <h2>Description</h2>
                    <p><?= html_entity_decode($forum_data[0]['description']) ?></p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 content">
                    <h2>Commentaire</h2>
                    <a href="/createcommentaire/<?= $forum_data[0]['id']?>"><button class="control--delete">Ajouter</button></a>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
                            <table class="table-latitude">
                                <thead>
                                    <th>User</th>
                                    <th>Commentaire</th>
                                    <th>Date</th>
                                    </th>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($forum_commentaire_valid as $key => $value){ ?>
                                            <tr>
                                                <td><?= $value["user_firstname"]?> <?= $value["user_lastname"]?></td>
                                                <td><?= $value["commentaire"] ?></td>
                                                <td><?= $value["createdAt"] ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p>Apparitions dans les recherches internet</p>
                </div>
            </div>
        </div>
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
