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
                            <a href="editCategorie?id=<?= $value['id']?>">Update</a>
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
            <?php if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error. "<br>";
                }
            }?>
        </div>
    </div>
</div> 
<script src="../../Style/src/js/deleteCategory.js"></script>
<script>
$('.control--add').css('background-color', localStorage.buttonAdd);
$('.control--delete').css('background-color', localStorage.buttonDelete);
$('.button').css('background-color', localStorage.button);
$('body').css('background-color', localStorage.background);
$('h1').css('color', localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>