<h1>Catégories</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <table class="table-latitude">
            <thead>
                <th>Nom</th>
                <th>Description</th>
                <th>Contrôles
                <button class="control--add" id="add-button">Ajouter</button>
                </th>
            </thead>
            <tbody>
                <?php 
                    foreach ($categorie_data as $key => $value){ ?>
                        <tr>
                            <td><?= $value["name"] ?></td>
                            <td><?= $value["description"] ?></td>
                            <td>
                                <button class="control--modify" id="<?= $value['id']?>">Modifier</button>
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
            <h2>Ajouter une catégorie</h2>
        </div>
        <div class="modal-body">
            <?php $this->includePartial("form", $category->getCategoryForm());?>
        </div>
    </div>
</div> 

<!-- modification d'une catégorie -->
<div class="modal" id="modal-edit">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>modifier une catégorie</h2>
        </div>
        <div class="modal-body">
            <?php $this->includePartial("form", $category->editCategoryForm());?>
        </div>
    </div>
</div> 

<!-- suppréssion d'une catégorie -->
<?php 
    foreach ($categorie_data as $key => $value){ ?>
        <div class="modal" id="modal-delete">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Supprimer une catégorie</h2>
                </div>
                <div class="modal-body">
                <button class="control--delete" onclick="window.location.href="/categorie?id= <?= $value['id'] ?>'">Supprimer</button>
                </div>
            </div>
        </div> 
<?php 
    }
?>
<script src="../../Style/src/js/deleteCategory.js"></script>