<h1>Mangas</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Editer un manga</h2>
        </div>
        <div class="modal-body">
            <?php $this->includePartial("form", $manga->getMangaForm($mangaInfos));?>
        </div>
    </div>
</div> 