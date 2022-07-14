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
                    foreach ($forum_commentaire as $key => $value){ ?>
                        <tr>
                            <td><?= $value["user_firstname"] ?></td>
                            <td><?= $value["forum_title"] ?></td>
                            <td><?= $value["commentaire"] ?></td>
                            <td>
                                <a href="forumcommentaire/edit/<?= $value['id']?>"><button class="control--delete">Valider</button></a>
                                <a href="forumcommentaire/delete/<?= $value['id']?>"><button class="control--delete">Refuser</button></a>
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
