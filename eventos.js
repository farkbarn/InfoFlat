$(document).ready(main);
var contador = 1;
function main(){
	$('.menu_bar').click(function(){
		// $('nav').toggle(); 

		if(contador == 1){
			$('nav.men').animate({left: '10'});
			$('nav.men').animate({position: 'absolute'});
			contador = 0;
		} else {
			contador = 1;
			$('nav.men').animate({left: '-100%'});
			$('nav.men').animate({position: 'fixed'});
		}
	});
};
