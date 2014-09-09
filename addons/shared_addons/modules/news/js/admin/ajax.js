/*
 * @author Luis Fernando Salazar
 * @description 
 */
$(document).ready(function()
{
	var base_url = $('#baseurl').html();  // seleccionamos la base url de un div
	var subCatArrayOld = new Array();
	
	$(document).on("click ", ".outstanding_news", function(event)
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
	
});