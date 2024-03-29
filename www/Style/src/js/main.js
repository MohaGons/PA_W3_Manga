var modal_add = $("#modal-add");
var modal_edit = $("#modal-edit");
//var modal_delete = $("#modal-delete");

// Get the button that opens the modal
var btn_add = $("#add-button");
var btn_edit = $(".control--modify");
//var btn_delete = $(".	--delete");

/*
$(".control--modify").click(function(){
	btn_edit = $(this).attr("id");
	console.log(btn_edit);
})
*/

// Get the <span> element that closes the modal
var span = $(".close");

// When the user clicks on the button, open the modal
btn_add.click(function(){
	modal_add.css("display", "block");
})

btn_edit.click(function(){
	modal_edit.css("display", "block");
})

/*
btn_delete.click(function(){
	modal_delete.css("display", "block");
})
*/

// When the user clicks on <span> (x), close the modal
span.click(function(){
	modal_add.css("display", "none");
	modal_edit.css("display", "none");
	//modal_delete.css("display", "none");
})

// When the user clicks anywhere outside of the modal, close it
$(window).click(function(event) {
  if (event.target == modal_add) {
    	modal_add.css("display", "none");	
  }
})

$(window).click(function(event) {
	if (event.target == modal_edit) {
		modal_edit.css("display", "none");	
	}
})
  
/*
$(window).click(function(event) {
	if (event.target == modal_delete) {
	  	modal_delete.css("display", "none");	
	}
})
*/

$(document).ready(function(){
	$('#menu-button').click(function () {
		$('#headerSidebar').toggleClass('open');
		$('#site-nav').toggleClass('open');
	})

	SliderInit();
})


function slideBtn(direction) {}

function SliderInit() {
	let slides = document.querySelectorAll(".slider-item");
	let slideBtns = document.querySelectorAll(".slider-control .btn");
	let prevBtn = slideBtns[0],
		nextBtn = slideBtns[1];
	//click handle
	prevBtn.onclick = (e) => {
		let activeSlider = document.querySelector(".slider-item.active");

		let slideCount = document.querySelector(".slider-count");

		if (activeSlider.dataset.target == 1) {
			let lastSlide = slides[slides.length - 1];
			slideCount.textContent = `${lastSlide.dataset.target}/${slides.length}`;

			lastSlide.classList.add("active");
		} else {
			activeSlider.previousElementSibling.classList.add("active");
			slideCount.textContent = `${activeSlider.previousElementSibling.dataset.target}/${slides.length}`;
		}

		activeSlider.classList.remove("active");
	};
	//next btn
	nextBtn.onclick = (e) => {
		let activeSlider = document.querySelector(".slider-item.active");
		let nextSlide = activeSlider.nextElementSibling;

		let slideCount = document.querySelector(".slider-count");

		if (activeSlider.dataset.target != 3) {
			nextSlide.classList.add("active");
			slideCount.textContent = `${nextSlide.dataset.target}/${slides.length}`;
		} else {
			let firstSlide = slides[0];
			firstSlide.classList.add("active");
			slideCount.textContent = `${firstSlide.dataset.target}/${slides.length}`;
		}

		activeSlider.classList.remove("active");
	};
}




// function sliderInit(slider){
// 	var container = $('<div></div>'); // div vide
// 	container.addClass('slides-container');
// 	container.html(slider.html());
// 	container.children('img').addClass('slide');
//
// 	slider.html(container);
//
// 	// Ajouter la navigation
// 	var nav = $('<nav></nav>');
// 	nav.append('<button class="prev"></button>');
// 	nav.append('<button class="next"></button>');
// 	slider.append(nav);
//
// 	// ajouter un attribut data-currentSlide au slider
// 	slider.attr('data-currentSlide', 0);
// 	slider.find('.prev').click(function(){
// 		prev(slider);
// 	})
// 	slider.find('.next').click(function(){
// 		next(slider);
// 	})
// 	startAutoPlay(slider);
// }

// function next(slider){
// 	var currentSlide = slider.attr('data-currentSlide');
// 	var nextSlide = Number(currentSlide) + 1;
// 	slider.attr('data-currentSlide', nextSlide);
// 	slide(slider);
// }
//
// function prev(slider){
// 	var currentSlide = slider.attr('data-currentSlide');
// 	var prevSlide = Number(currentSlide) - 1;
// 	slider.attr('data-currentSlide', prevSlide);
// 	slide(slider);
// }
//
// function slide(slider){
//
// 	var currentSlide = slider.attr('data-currentSlide');
// 	var container = slider.children('.slides-container');
// 	var left = slider.width() * currentSlide * -1;
// 	container.css('left', left);
//
// 	disableNav(slider);
// 	container.on('transitionend',function(){
// 		container.off('transitionend');
// 		enableNav(slider);
// 	})
//
// 	if(currentSlide == -1){
// 		//Cloner la dernière image pour la mettre avant la première
// 		var clone = container.find('.slide:last').clone();
// 		clone.css({
// 			'position':'absolute',
// 			'top': 0,
// 			'left': 0,
// 			'transform': 'translateX(-100%)'
// 		})
// 		container.prepend(clone); // Ajouter le clone au début du container de slides
//
// 		// Ecouter la fin de la transition
// 		container.on('transitionend', function(){
//
// 			container.off('transitionend'); // Supprimer l'écouteur car cette fonction ne doit être lancée qu'une fois
//
// 			// Enlever la transition du container
// 			container.css('transition', 'none');
//
// 			// Ramener le slider sur la dernière image
// 			var lastImageIndex = container.find('.slide').length - 1 - 1; // On retire 1 pour avoir l'index et encore un pour ne pas compter le clone présent dans le container
// 			slider.attr('data-currentSlide', lastImageIndex);
// 			slide(slider);
//
//
// 			setTimeout(function(){
//
// 				enableNav(slider);
//
// 				// Supprimer le clone situé au début du container
// 				container.find('.slide:first').remove();
//
// 				// Rétablir la transition du container
// 				container.css('transition', 'left 1s');
// 			}, 10);
//
// 		})
//
// 	}
//
// 	if(currentSlide == container.find('.slide').length){
//
// 		//Cloner la première image pour la mettre après la dernière
// 		var clone = container.find('.slide:first').clone();
// 		container.append(clone); // Ajouter le clone à la fin du container de slides
//
// 		// Ecouter la fin de la transition
// 		container.on('transitionend', function(){
//
// 			container.off('transitionend'); // Supprimer l'écouteur car cette fonction ne doit être lancée qu'une fois
//
// 			// Enlever la transition du container
// 			container.css('transition', 'none');
//
// 			// Ramener le slider sur la première image
// 			slider.attr('data-currentSlide', 0);
// 			slide(slider);
//
//
// 			setTimeout(function(){
// 				enableNav(slider);
//
// 				// Supprimer le clone situé à la fin du container
// 				container.find('.slide:last').remove();
//
// 				// Rétablir la transition du container
// 				container.css('transition', 'left 1s');
// 			}, 10);
//
// 		})
// 	}
//
// 	stopAutoPlay(slider); // pas vraiment nécessaire
// 	startAutoPlay(slider);
// }


// function disableNav(slider){
// 	slider.find('nav').css({
// 		'pointer-events':'none',
// 		'opacity':'0.5'
// 	})
// }
//
// function enableNav(slider){
// 	slider.find('nav').css({
// 		'pointer-events':'auto',
// 		'opacity':'1'
// 	})
// }
//
//
// var interval;
//
// function startAutoPlay(slider){
// 	interval = setInterval(function(){
// 		next(slider)
// 	}, 4000);
// }
//
// function stopAutoPlay(slider){
// 	clearInterval(interval)
// }











