/*
 * @author Luis Fernando Salazar
 * @description 
 */
$(document).ready(function()
{
	var base_url = $('#baseurl').html();  // seleccionamos la base url de un div
	var subCatArrayOld = new Array();
	
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
			url: base_url+'admin/multi_upload_files/orden_categories/',
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