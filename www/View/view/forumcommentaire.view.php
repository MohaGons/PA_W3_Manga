<h1>Commentaire</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <table class="table-latitude">
            <thead>
                <th>User</th>
                <th>Forum</th>
                <th>Commentaire</th>
                <th>Action</th>
                </th>
            </thead>
            <tbody>
                <?php 
                    foreach ($forum_commentaire_data as $key => $value){ ?>
                        <tr>
                            <td><?= $value["id_user"] ?></td>
                            <td><?= $value["id_forum"] ?></td>
                            <td><?= $value["commentaire"] ?></td>
                            <td>
                                <a href="?action=valide&id=<?= $value['id'] ?>">
                                <button class="control--delete" id="<?= $value['id']?>">Refuser</button>
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
