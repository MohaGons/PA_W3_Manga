<h1>Forum</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <div class="modal-header">
            <h2>Editer un forum</h2>
        </div>
        <div class="modal-body">
            <?php $this->includePartial("form", $forum->editParamForum($forum_data, $categorie_data));?>
        </div>
    </div>
</div>

<script>
    ClassicEditor
    .create( document.querySelector( '#descriptionForum' ) )
    .catch( error => {
        console.error( error );
    } );
</script>