<h1>Forum</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col--flex">
        <table class="table-latitude">
            <thead>
                <th class="col-xl-4">Titre</th>
                <th class="col-xl-6">Description</th>
                <th class="col-xl-2">Contrôles
                <button class="control--add" id="add-button">Ajouter</button>
                </th>
            </thead>
            <tbody>
                <?php 
                    foreach ($forums_data as $key => $value){ ?>
                        <tr>
                            <td><?php
                            if (strlen($value["title"]) >= 40) {
                                echo substr($value["title"], 0, 40) . "...";
                            } else {
                                echo $value["title"];
                            }
                            ?></td>
                            <td><?php
                            if (strlen($value["description"]) >= 60) {
                                echo html_entity_decode(substr($value["description"], 0, 60) . "...");
                            } else {
                                echo html_entity_decode($value["description"]);
                            }
                             ?></td>
                            <td>
                                <a href="forum/edit/<?= $value['id']?>">Update</a>
                                <button class="control--delete" id="<?= $value['id']?>">Supprimer</button>
                            </td>
                        </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ajout d'une catégorie -->
<div class="modal" id="modal-add">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Ajouter un forum</h2>
        </div>
        <div class="modal-body">
            <?php $this->includePartial("form", $forum->getForumForm($categorie_data));?>
            <?php if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error. "<br>";
                }
            }?>
        </div>
    </div>
</div> 
<script src="../../../Style/src/js/deleteForum.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#descriptionForum' ) )
    .catch( error => {
        console.error( error );
    } );
</script>