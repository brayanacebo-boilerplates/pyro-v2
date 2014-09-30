
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#home-2">
                            <i class="fa fa-list-alt"></i>
                            Lista de productos
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#about-2">
                            <i class="fa fa-th"></i>
                            Categorías
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#contact-2">
                            <i class="fa fa-file-text"></i>
                            Introducción
                        </a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home-2" class="tab-pane active">
                        <a type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo producto</a>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th class="hidden-phone">Descripción</th>
                                        <th>Destacado</th>
                                        <th style="width:20%;">Acciones</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td>Lorem ipsum dolor sit</td>
                                    <td><img src="<?php echo BASE_URL . $this->admin_theme->path; ?>/img/gallery/image1.jpg" alt="" height="90"></td>
                                    <td class="hidden-phone">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium</td>
                                    <td class="center">
                                        <form class="form-horizontal bucket-form" method="get">
                                            <div class="form-group">
                                                <div class="col-sm-9 icheck ">
                                                    <div class="flat-purple single-row">
                                                        <div class="radio ">
                                                            <input type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="">
                                        <a href="" class="btn btn-info btn-sm tooltips" title="" data-placement="top" data-toggle="tooltip" data-original-title="Editar">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="btn btn-success btn-sm" title="Imágenes"><i class="fa fa-picture-o"></i></a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal" href="#ModalEliminar"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <tr class="gradeX">
                                    <td>Lorem ipsum dolor sit</td>
                                    <td><img src="<?php echo BASE_URL . $this->admin_theme->path; ?>/img/gallery/image1.jpg" alt="" height="90"></td>
                                    <td>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium</td>
                                    <td class="center hidden-phone">
                                        <form class="form-horizontal bucket-form" method="get">
                                            <div class="form-group">
                                                <div class="col-sm-9 icheck ">
                                                    <div class="flat-purple single-row">
                                                        <div class="radio ">
                                                            <input type="checkbox">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="">
                                        <a class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-success btn-sm"><i class="fa fa-picture-o"></i></a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal" href="#ModalEliminar"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            </div>
                    </div>
                    <div id="about-2" class="tab-pane">
                        <div class="col-lg-12">
                            
                        </div>
                        <section class="panel">
                            <a type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva categoría</a>
                        </section>
                        <div class="border-head">
                            <h3>Organiza las categorías con solo arrastrarlas</h3>
                        </div>
                        <div class="dd" id="nestable_list_3">
                            <ol class="dd-list">
                                <li class="dd-item dd3-item" data-id="13">
                                    <div class="dd-handle dd3-handle "></div>
                                    <div class="dd3-content">Item 13 <a class="btn btn-info btn-xs pull-right"><i class="fa fa-pencil"></i> Editar</a></div>
                                </li>
                                <li class="dd-item dd3-item" data-id="14">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">Item 14 <a class="btn btn-info btn-xs pull-right"><i class="fa fa-pencil"></i> Editar</a></div>
                                </li>
                                <li class="dd-item dd3-item" data-id="15">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">Televisores <a class="btn btn-info btn-xs pull-right"><i class="fa fa-pencil"></i> Editar</a></div>
                                    <ol class="dd-list">
                                        <li class="dd-item dd3-item" data-id="16">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content">LCD <a class="btn btn-info btn-xs pull-right"><i class="fa fa-pencil"></i> Editar</a></div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="17">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content">LED <a class="btn btn-info btn-xs pull-right"><i class="fa fa-pencil"></i> Editar</a></div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="18">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content">Plasma <a class="btn btn-info btn-xs pull-right"><i class="fa fa-pencil"></i> Editar</a></div>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div id="contact-2" class="tab-pane ">
                        <div class="form">
                            <form action="#" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label col-sm-2">Introducción</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control ckeditor" name="editor1" rows="6"></textarea>
                                        <span class="help-block">Evite pegar texto directamente desde un sitio web u otro editor de texto.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Eliminar Registro</h4>
            </div>
            <div class="modal-body">

                Esta seguro de eliminar este registro?

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-danger" type="button"> Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<script type="text/javascript">
$(document).ready(function() {
    $('#dynamic-table').dataTable( {
        //"aaSorting": [[ 4, "desc" ]]
        "bSort": false,
        //"bLengthChange": false,
        //"bInfo": false,
        "bAutoWidth": false,
        "oLanguage": {
          "sInfo": "Mostrando _START_ a _END_ de _TOTAL_",
          "sInfoEmpty": "",
          "sSearch": "Buscar:",
          "sLoadingRecords": "Espera un poco - cargando...",
          "oPaginate": {
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          /*"sLengthMenu": '<select class="form-control">'+
            '<option value="50" selected>50</option>'+
            '<option value="100">100</option>'+
            '</select> Registros por página',*/
          "sZeroRecords": '<div class="alert alert-info fade in">'+
            '<button data-dismiss="alert" class="close close-sm" type="button">'+
            '<i class="fa fa-times"></i>'+
            '</button>'+
            '<strong>Lo sentimos!</strong> No se han encontrado registros en la busqueda. <br><br>'+
            '</div>'
        },
    } );

    $('.flat-purple input').iCheck({
        checkboxClass: 'icheckbox_flat-purple',
        radioClass: 'iradio_flat-purple'
    });

    $('#nestable_list_3').nestable();

    /*
     * Insert a 'details' column to the table
     */
    //var nCloneTh = document.createElement( 'th' );
    //var nCloneTd = document.createElement( 'td' );
    //nCloneTd.innerHTML = '<img src="assets/advanced-datatable/examples/examples_support/details_open.png">';
    //nCloneTd.className = "center";
});
</script>