<h1>Ajouter un commentaire</h1>

<div class="modal-body">
    <?php $this->includePartial("form", $forum_commentaire->getCreateCommentaireForm());?>
    <?php if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error. "<br>";
        }
    }?>
</div>
