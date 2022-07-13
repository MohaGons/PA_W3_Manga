<h1>Manga</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <table class="table-latitude">
            <thead>
                <th>Nom</th>
                <th>Description</th>
                <th>Contrôles
                <a href="manga/create"><button class="control--delete">Ajouter</button></a>
                </th>
            </thead>
            <tbody>
                <?php 
                    foreach ($manga as $key => $value){ ?>
                        <tr>
                            <td><?= $value["title"] ?></td>
                            <td><?= $value["description"] ?></td>
                            <td>
                                <a href="manga/edit/<?= $value['id']?>">Update</a>
                                <a href="manga/delete/<?= $value['id']?>"><button class="control--delete">Supprimer</button></a>
                            </td>
                        </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
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
