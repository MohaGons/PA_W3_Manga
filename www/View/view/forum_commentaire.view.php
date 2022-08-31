<h1>Ajouter un commentaire</h1>

<a href="/forum/detail/<?= $forum_data[0]['id'] ?>"><button class="control--delete">Retour</button></a>

<div class="modal-body">
    <?php $this->includePartial("form", $forum_commentaire->getCreateCommentaireForm());?>
    <?php if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error. "<br>";
        }
    }?>
</div>

<script>
$('.control--add').css('background-color', localStorage.buttonAdd);
$('.control--delete').css('background-color', localStorage.buttonDelete);
$('.button').css('background-color', localStorage.button);
$('body').css('background-color', localStorage.background);
$('h1').css('color', localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>
