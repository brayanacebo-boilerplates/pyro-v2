$(function()
{
	var base_url = $('#baseurl').html();  // seleccionamos la base url de un div
	
	
	//$(".dropzone").dropzone({ url : base_url+'index.php?upload/upload_file/'+$('#idadjuntos').val() });
	Dropzone.autoDiscover = false;
	$("#form_proce_anexos").dropzone({
		url : base_url+'admin/multi_upload_files/upload_file/'+$('#idadjuntos').val(),
		//dictDefaultMessage: "Datei bitte hier ablegen!",
		uploadMultiple: true,
		maxFilesize: 5,
		acceptedFiles: '.gif,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx,.txt,.pdf,.GIF,.JPG,.JPEG,.PNG,.DOC,.DOCX,.XLS,.XLSX,.TXT,.PDF',
		complete: function(file)
		{
			refresh_files($('#idadjuntos').val());
			this.removeFile(file);
		},
		error: function()
		{
			alert("Ocurrió un error. Por favor inténtelo de nuevo.");
		},
	});
	
	if ($("#files").length > 0)
	{
		$('#files').photobox('a.photobox',{time:3000});
	}
	
	$(document).on("click", ".renombrar-archivo", function(event)
	{
		event.preventDefault();
		element = $(this);
		//nombre = prompt('Ingrese un nuevo nombre para el archivo actual: ', $(this).find('.nom-archivo').html());
		idproceso = $('#idadjuntos').val();
		nomfile = element.find('.nom-archivo').html();
		nomfile_ext = element.data('nomfile');
		var newName = prompt("Ingrese un nuevo nombre para el archivo actual: ", nomfile);
		if (newName != null)
		{
			$.ajax({
				url: element.attr('href') +'/',
				secureuri : false,
				dataType : 'json',
				type: "POST",
				data: ({nomfile: nomfile_ext, newname: newName}),
				success: function(data, status)
				{
					if(data.status != 'error')
		            {
		               refresh_files(idproceso);
		            }
		            else
		            {
		            	alert(data.msg);
		            }
				},
				error: function(err)
		        {
		        	alert("Ocurrió un error. Por favor inténtelo de nuevo.");
		        }
			});
		}
		else
		{
			alert('Por favor ingrese un nombre');
		}
	});
	
	$(document).on("click", ".delete_file_link", function(event)
	{
	   	event.stopPropagation();
	   	event.preventDefault();
	   	var link = $(this);
	   	var deleteFile=confirm("¿Está seguro de que desea eliminar este archivo?");
	   	if (deleteFile==true)
	   	{
		    $.ajax({
	        	url         : base_url+'admin/multi_upload_files/delete_file/' + link.data('file_id'),
	        	dataType : 'json',
	        	type: "POST",
				data: ({nomfile: link.data('nomfile')}),
	        	success     : function (data)
	        	{
	            	files = $(files);
	            	if (data.status === "success")
	            	{
	               		link.parents('.dz-preview').fadeOut('fast', function()
	               		{
	                  		link.remove();
	               		});
	            	}
	            	else
	            	{
	               		alert(data.msg);
	            	}
	         	},
	         	error: function(err)
		        {
		        	alert("Ocurrió un error. Por favor inténtelo de nuevo.");
		        }
	      	});
		}
	});
	
	// rotar las imagenes
	$(document).on("click", ".rotate_file_link", function(event)
	{
	   	event.stopPropagation();
	   	event.preventDefault();
	   	var link = $(this);
	   	idproceso = $('#idadjuntos').val();
	   	
	   	var rotateFile=confirm("¿Está seguro de que desea rotar esta imagen?");
	   	if (rotateFile==true)
	   	{
	    	$.ajax({
	        	url         : base_url+'admin/multi_upload_files/rotate_file/' + link.data('file_id'),
	        	dataType : 'json',
	        	success     : function (data)
	        	{
	           		//files = $(#files);
	            	files = $(files);
	            	if (data.status === "success")
	            	{
	               		refresh_files(idproceso);
	            	}
	            	else
	            	{
	               		alert(data.msg);
	            	}
	         	},
	         	error: function(err)
		        {
		        	alert("Ocurrió un error. Por favor inténtelo de nuevo.");
		        }
	      	});
		}
	});
	
	function refresh_files(id)
	{
	   	$.ajax({
			//type: "POST",
			url: base_url+'admin/multi_upload_files/files/'+id,
			beforeSend: function () {
			    $("#files").html('<img src="'+base_url+'uploads/default/loading.gif" width="28" height="28"/>');
			},
			success: function(html){
				$("#files").html(html);
				alinearImagenesDropzone();
			},
			error: function(err)
	        {
	        	bootbox.alert("Ocurrió un error. Por favor inténtelo de nuevo.");
	        }
		});
	}
	
	function alinearImagenesDropzone()
	{
		anchoPantalla = window.innerWidth;
		// la primera vez que entra cambiamos el margen externo a las imagenes y las centramos cambiando el margen interno del contenedor
		margenExt = (anchoPantalla <= 480 ? 7 : 15);
		
		$(".dropzone .dz-preview,.dropzone-previews .dz-preview").css('margin', margenExt+'px');
		
		// tenemos en cuenta que si el ancho es mayor que 872 el area siempre va a ser de 800px y que cuando el ancho es menor que 768 el margen lateral se estrecha
		margenInt = 10;
		anchoDisp = (anchoPantalla >= 872 ? 800 : anchoPantalla - (anchoPantalla > 768 ? 72 : 32));
		// restamos 1px del borde y el padding de cada lado
		anchoDisp -= (1 + margenInt) * 2;
		// determinamos cuantos elementos caben
		tamanoImagen = 114 + (margenExt * 2);
		numImagenes = Math.floor(anchoDisp / tamanoImagen);
		anchoSobrante = anchoDisp - (tamanoImagen * numImagenes);
		margenInt += (anchoSobrante / 2);
		$(".dropzone").css('padding-left', margenInt+'px');
	}
});
