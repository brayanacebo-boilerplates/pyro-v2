/*
 * @author Luis Fernando Salazar
 * @description 
 */
$(document).ready(function()
{
	var base_url = $('#baseurl').html();  // seleccionamos la base url de un div
	var selCategory = $('#selCategory').html();  // seleccionamos la categoria si tiene alguna
	var page_ajax = parseInt($('#page_ajax').html());
	
	$('#upload_items').scrollPagination({
		'contentPage': base_url+'albums/ajax_items/'+selCategory+'/',
		'contentData': { 'page_ajax': function() {return parseInt($('#page_ajax').html()); } }, 
		'scrollTarget': $(window),
		'heightOffset': 10,
		'beforeLoad': function(){ 
		  // before load function, you can display a preloader div
			$('#ajax_loading').fadeIn();	
		},
		'afterLoad': function(elementsLoaded){
			 $('#ajax_loading').fadeOut();
			 $('#page_ajax').html( parseInt($('#page_ajax').html()) + 1);
			 var i = 0;
			 $(elementsLoaded).fadeInWithDelay();
			 if($("#stop_scroll").length > 0)
			 {
			 	$('#upload_items').stopScrollPagination();
			 }
		}
	});
	
	// code for fade in element by element
	$.fn.fadeInWithDelay = function(){
		var delay = 0;
		return this.each(function(){
			$(this).delay(delay).animate({opacity:1}, 175);
			delay += 100;
		});
	};
});