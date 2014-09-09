/*
 * @author Luis Fernando Salazar
 * @description 
 */
$(document).ready(function()
{
	var base_url = $('#baseurl').html();  // seleccionamos la base url de un div
	var subCatArrayOld = new Array();
	
	$(document).on("click ", ".outstanding_product", function(event)
	{
		event.preventDefault();
		imageSrc = $(this).find('img').attr('src');
		element = $(this);
		$.ajax({
			url: $(this).attr('href'),
			dataType : 'json',
			beforeSend: function () {
			    $(this).html('<img src="'+base_url+'uploads/default/loading.gif" width="28" height="28"/>');
			},
			success: function(data)
			{
				if (data.status == "error")
            	{
               		alert(data.msg);
            	}
            	else
            	{
            		if(imageSrc != base_url+'uploads/default/estrella.png')
					{
						element.find('img').attr('src', base_url+'uploads/default/estrella.png');
					}
					else
					{
						element.find('img').attr('src', base_url+'uploads/default/estrella_gris.png');
					}
            	}
			},
			error: function(err)
	        {
	        	alert("Ocurrió un error. Por favor inténtelo de nuevo.");
	        }
		});
	});
	
	$(document).on("click", ".view_quote_items", function(event)
	{
		event.preventDefault();
		//alert($(this).attr('href'));
		$.ajax({
			type: "POST",
			url: base_url + $(this).attr('href'),
			beforeSend: function () {
			    $("#cboxContent").html('<img src="'+base_url+'uploads/default/loading.gif" width="28" height="28"/>');
			},
			success: function(html){
				$("#cboxContent").html(html);
			},
			error: function(err)
	        {
	        	alert("Ocurrió un error. Por favor inténtelo de nuevo.");
	        }
		});
	});
	
	$(document).on("click ", ".promotions_product", function(event)
	{
		event.preventDefault();
		imageSrc = $(this).find('img').attr('src');
		element = $(this);
		$.ajax({
			url: $(this).attr('href'),
			dataType : 'json',
			beforeSend: function () {
			    $(this).html('<img src="'+base_url+'uploads/default/loading.gif" width="28" height="28"/>');
			},
			success: function(data)
			{
				if (data.status == "error")
            	{
               		alert(data.msg);
            	}
            	else
            	{
            		if(imageSrc != base_url+'uploads/default/estrella.png')
					{
						element.find('img').attr('src', base_url+'uploads/default/estrella.png');
					}
					else
					{
						element.find('img').attr('src', base_url+'uploads/default/estrella_gris.png');
					}
            	}
			},
			error: function(err)
	        {
	        	alert("Ocurrió un error. Por favor inténtelo de nuevo.");
	        }
		});
	});
	
	/*$(document).on("mousemove", ".sortable", function(event) // evento mouseover o mousemove
    {*/
	   	$(".sortable").sortable
	   	({
	   		
			update : function ()
	        {
	        	
	        },
	       
	       	create: function( event, ui )
	        {
	        	// guardamos la posición de las categorias en un array global
	        	if(subCatArrayOld.length == 0)
	        	{
	        		subCatArrayOld = $(this).sortable("toArray");
	        	}
	        },
	        stop:   function(event, ui)
	        {
	        	idParent = $(this).parents().eq(0).attr('id');
	        	if(isNaN(idParent))
	        	{
	        		idParent = 0;
	        	}
	        	subCatArray = $(this).sortable("toArray");
	        	// si la posición de los widgets cambio, guardamos el cambio en la BD
	        	console.log(subCatArray);
	        	console.log(subCatArrayOld);
	            if(subCatArrayOld.compare(subCatArray) === false)
	            {
	            	Sortable($(this), subCatArray, idParent);
	            }
	        },
	   	});
   	//});
   	
   	function Sortable(element, subCatArray, idParent)
   	{
		$.ajax
		({
			type: "POST",
			dataType: "json",
			url: base_url+'admin/products/orden_categories/',
			data: ({subCatArray: subCatArray, idParent: idParent}),
			beforeSend: function ()
			{
				$('#ajax_message').html('<img src="'+base_url+'uploads/default/loading.gif" width="28" height="28"/>');
			},
			success: function(data)
			{
				//$("#carga").empty();
				//alert(data.msg);
		        if(data.status == 'error')
				{
					$('#ajax_message').html('<div style="color: red">'+ data.msg +'</div>');
					//location.reload();
				}
				else
				{
					$('#ajax_message').html('<div style="color: green">'+ data.msg +'</div>');
				}
			},
			error: function(err)
	        {
	        	alert("Ocurrió un error. Por favor inténtelo de nuevo.", err);
	        	//$("#carga").empty();
	        }
		});
   	}
   	
   	// comparar dos array para saber si son iguales
   	Array.prototype.compare = function (array)
   	{
	    // if the other array is a falsy value, return
	    if (!array)
	        return false;
	
	    // compare lengths - can save a lot of time
	    if (this.length != array.length)
	        return false;
	
	    for (var i = 0; i < this.length; i++) {
	        // check if we have nested arrays
	        if (this[i] instanceof Array && array[i] instanceof Array) {
	            // recurse into the nested arrays
	            if (!this[i].compare(array[i]))
	                return false;
	        }
	        else if (this[i] != array[i]) {
	            // Warning - two different object instances will never be equal: {x:20} != {x:20}
	            return false;
	        }
	    }
	    return true;
	}
});