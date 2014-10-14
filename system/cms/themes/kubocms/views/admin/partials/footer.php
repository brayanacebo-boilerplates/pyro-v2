<script type="text/javascript">
$(document).ready(function() {
	/* JS para datatables */
    $('#dynamic-table').dataTable( {
        "bSort": false,
        "bAutoWidth": false,
        "oLanguage": {
          "sInfo": "Mostrando _START_ a _END_ de _TOTAL_",
          "sInfoEmpty": "",
          "sLengthMenu": "_MENU_ registros por página",
          "sSearch": "Buscar:",
          "sLoadingRecords": "Espera un poco - cargando...",
          "oPaginate": {
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
            "sZeroRecords": '<strong>Lo sentimos!</strong> No se han encontrado registros en la busqueda'
        },
    } );
    $('#nestable_list_3').nestable();
    $('.default-date-picker').datepicker({
        format: 'yyyy-mm-dd'
    });
});

$('#add-without-image').click(function(){
    $.gritter.add({
        title: 'This is a notice without an image!',
        text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" style="color:#ccc">magnis dis parturient</a> montes, nascetur ridiculus mus.'
    });
    return false;
});
</script>