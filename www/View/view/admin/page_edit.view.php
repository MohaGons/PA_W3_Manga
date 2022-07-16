<h1>Page</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <div class="modal-header">
            <h2>Editer une page</h2>
        </div>
        <div class="modal-body">
            <?php $this->includePartial("form", $page->editParamPage($page_data));?>
            <?php if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error. "<br>";
                }
            }?>
        </div>
    </div>
</div>

<script>
    ClassicEditor
    .create( document.querySelector( '#editDescriptionPage' ) )
    .catch( error => {
        console.error( error );
    } );
</script>
<script>
$('.control--add').css('background-color', localStorage.buttonAdd);
$('.control--delete').css('background-color', localStorage.buttonDelete);
$('.button').css('background-color', localStorage.button);
$('body').css('background-color', localStorage.background);
$('h1').css('color', localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>