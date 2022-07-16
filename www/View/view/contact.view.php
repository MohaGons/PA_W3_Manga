<form>
    <input>
    <button class="button button--primary">Contact</button>
    <button class="button button--secondary">Contact</button>
    <button class="button button--success">Contact</button>
    <button class="button button--danger">Contact</button>
    <button class="button button--warning">Contact</button>
    <button class="button button--info">Contact</button>
    <button class="button button--light">Contact</button>
    <button class="button button--dark">Contact</button>
</form>
<script>
$('.control--add').css('background-color', localStorage.buttonAdd);
$('.control--delete').css('background-color', localStorage.buttonDelete);
$('.button').css('background-color', localStorage.button);
$('body').css('background-color', localStorage.background);
$('h1').css('color', localStorage.h1Color);
$("*").css("font-family", localStorage.font);
</script>
