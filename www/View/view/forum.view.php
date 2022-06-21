<h1>Forum</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <table class="table-latitude">
            <thead>
                <th>Titre</th>
                <th>Description</th>
                <th>Contrôles
                <button class="control--add" id="add-button">Ajouter</button>
                </th>
            </thead>
            <tbody>
                <?php 
                    foreach ($forums_data as $key => $value){ ?>
                        <tr>
                            <td><?= $value["title"] ?></td>
                            <td><?= $value["description"] ?></td>
                            <td>
                            <a href="editForum?id=<?= $value['id']?>">Update</a>
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
            <?php $this->includePartial("form", $forum->getForumForm());?>
        </div>
    </div>
</div> 
<script src="../../Style/src/js/deleteForum.js"></script>