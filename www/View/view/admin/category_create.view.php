<h1>catégorie</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <div class="modal-header">
            <h2>Créer une catégorie</h2>
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
