var modal = $("#modal-add");

// Get the button that opens the modal
var btn = $("#add-button");

// Get the <span> element that closes the modal
var span = (".close")[0];

// When the user clicks on the button, open the modal
btn.click(function(){
	modal.css("display", "block")
})

// When the user clicks on <span> (x), close the modal
span.click(function(){
	modal.css("display", "none")
})

// When the user clicks anywhere outside of the modal, close it
$(window).click(function( event ) {
  if (event.target == modal) {
    modal.css("display", "none")
  }
})

$(".control--delete").click(function(){
    window.location = "http://localhost/categorie";
})