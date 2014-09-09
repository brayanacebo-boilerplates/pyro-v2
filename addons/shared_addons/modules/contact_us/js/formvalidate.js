$(document).ready(function()
{
	var base_url = $('#baseurl').html();  // seleccionamos la base url de un div
	
	// personalizamos los mensajes
	jQuery.extend
	(
		jQuery.validator.messages, 
		{
		    required: "Este campo es obligatorio",
		    remote: "Por favor corrija este campo",
		    email: "Por favor escriba un correo válido",
		    url: "Por favor escriba una url válida.",
		    date: "Por favor escriba una fecha válida.",
		    dateISO: "Por favor escriba una fecha válida (ISO).",
		    number: "El campo debe ser numerico.",
		    digits: "Por favor use sólamente dígitos.",
		    creditcard: "Por favor introduzca un número de tarjeta de crédito válido.",
		    equalTo: "Por favor introduzca el mismo valor del anterior.",
		    accept: "Por favor introduzca un valor con una extensión válida.",
		    maxlength: jQuery.validator.format("Por favor escriba máximo {0} caracteres."),
		    minlength: jQuery.validator.format("Por favor escriba mínimo {0} caracteres."),
		    rangelength: jQuery.validator.format("Por favor escriba un valor entre {0} y {1} caracteres de longitud."),
		    range: jQuery.validator.format("Por favor escriba un valor entre {0} y {1}."),
		    max: jQuery.validator.format("Por favor introduzca un valor menor o igual a {0}."),
		    min: jQuery.validator.format("Por favor introduzca un valor mayor o igual a {0}.")
		},
	
		$.validator.addMethod
		(
		    "date",
		    function(value, element) {
		        //return Funciones_JS_Sinergia.esFecha(value);
		    },
		    "Por favor digite una fecha válida usando el formato dd-mm-aaaa."
		)
 	);
    
    // contactenos
	$('.form_contac_ajax').validate({
        rules:{
        	name : {required: true, minlength: 2, maxlength: 100},
            email : {required: true, email:true, maxlength: 100},
            phone : {required: true, minlength: 5, maxlength: 30},
            cell : {minlength: 10, maxlength: 30},
        	company : {maxlength: 100},
        	message : {required: true, maxlength: 455},
        },
        highlight: function (element) {
        	$(element).addClass('form_txt_error');
        	$(element).removeClass('error');
        },
        unhighlight: function(element) {
        	$(element).removeClass('form_txt_error');
        },
        focusInvalid:true,
        onfocusout:false,
        submitHandler: function(event) 
        {
           	llamadaAjaxContact('.form_contac_ajax');  // mandamos el nombre del formulario
        }
    });
	
	// funcion de jquery donde recibimos el nombre del formulario
    function llamadaAjaxContact(formname)
	{
		$.ajax({
			url: $(formname).attr('action'),
			type: 'POST',
			dataType : 'json',
			data:  $(formname).serialize(),
			beforeSend: function ()
			{
			    $('#loading_contacts').html('<img src="'+base_url+'uploads/default/loading.gif" width="28" height="28"/>');
			},
			success: function(data)
			{
				$('#loading_contacts').html(data.msg);
				if(data.status == 'error')
				{
					$('#loading_contacts').html('<div style="color: red">'+ data.msg +'</div>');
				}
				else
				{
					$('#loading_contacts').html('<div style="color: green">'+ data.msg +'</div>');
				}
			},
			error: function(err)
	        {
	        	alert("Ocurrió un error. Por favor inténtelo de nuevo.");
	        }
		});
	}
	
});