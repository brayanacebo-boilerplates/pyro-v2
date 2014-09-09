<section class="title">
    <h4>Home</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-banner"><span>Slider</span></a></li>
                <li><a href="#page-outstanding"><span>Noticias Destacadas</span></a></li>
                <li><a href="#page-services"><span>Servicios Destacadas</span></a></li>
                <li><a href="#page-text-info"><span>Texto Informativo</span></a></li>
				<li><a href="#page-banner-customers"><span>Slider Clientes</span></a></li>
            </ul>

            <!-- BANNER -->

            <div class="form_inputs" id="page-banner">
                <fieldset>
                    <?php echo anchor('admin/home/edit_banner/', '<span>+ Crear Slide</span>', 'class="btn blue"'); ?>
                    <br>
                    <br>
                    <?php if (!empty($banner)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Imagen</th>
                                    <th style="width: 20%">Titulo</th>
                                    <th style="width: 20%">Texto</th>
                                    <th style="width: 20%">Link</th>
                                    <th class="width: 20%">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="inner filtered"><?php $this->load->view('admin/partials/pagination') ?></div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($banner as $slide): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($slide->image)): ?>
                                                <img src="<?php echo site_url($slide->image); ?>" style="width: 139px;">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $slide->title ?></td>
                                        <td><?php echo $slide->text ?></td>
                                        <td><a href="<?php echo $slide->link ?>"><?php echo $slide->link ?></a></td>
                                        <td>
                                            <?php echo anchor('admin/home/edit_banner/' . $slide->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/home/delete_banner/' . $slide->id, lang('global:delete'), array('class' => 'confirm btn red small')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay un slide actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>

            <!-- NOTICIAS -->

            <div class="form_inputs" id="page-outstanding">
                <fieldset>

                    <?php
                    if(count($outstanding_news) < 3)
                    {
                    	echo anchor('admin/home/edit_outstanding/1', '<span>+ Crear Destacado de Noticias</span>', 'class="btn blue"');
                    }
                    ?>
                    <br>
                    <br>

                    <?php if (!empty($outstanding_news)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Imagen</th>
                                    <th style="width: 30%">Titulo</th>
                                    <th style="width: 30%">Link</th>
                                    <th class="width: 20%">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="inner filtered"><?php $this->load->view('admin/partials/pagination') ?></div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($outstanding_news as $outstanding): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($outstanding->image)): ?>
                                                <div style="height: 80px;width: 170px;overflow: hidden"><img src="<?php echo site_url($outstanding->image); ?>" width="170"></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $outstanding->title ?></td>
                                        <td><a href="<?php echo $outstanding->link ?>"><?php echo $outstanding->link ?></a></td>
                                        <td>
                                            <?php echo anchor('admin/home/edit_outstanding/'. $outstanding->type .'/'. $outstanding->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/home/delete_outstanding/' . $outstanding->id.'#page-outstanding', lang('global:delete'), array('class' => 'confirm btn red small')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay Noticias Destacadas actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>

			<!-- SERVICIOS -->

			<div class="form_inputs" id="page-services">
                <fieldset>

                    <?php
                    if(count($outstanding_services) < 4)
                    {
                    	echo anchor('admin/home/edit_outstanding/2', '<span>+ Crear Destacado de Servicios</span>', 'class="btn blue"');
                    }?>
                    <br>
                    <br>

                    <?php if (!empty($outstanding_services)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Imagen</th>
                                    <th style="width: 30%">Titulo</th>
                                    <th style="width: 30%">Link</th>
                                    <th class="width: 20%">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="inner filtered"><?php $this->load->view('admin/partials/pagination') ?></div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($outstanding_services as $outstanding): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($outstanding->image)): ?>
                                                <div style="height: 80px;width: 170px;overflow: hidden"><img src="<?php echo site_url($outstanding->image); ?>" width="170"></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $outstanding->title ?></td>
                                        <td><a href="<?php echo $outstanding->link ?>"><?php echo $outstanding->link ?></a></td>
                                        <td>
                                            <?php echo anchor('admin/home/edit_outstanding/'. $outstanding->type .'/'. $outstanding->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/home/delete_outstanding/' . $outstanding->id, lang('global:delete'), array('class' => 'confirm btn red small')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay Noticias Destacadas actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>

            <!-- TEXTO INFORMATIVO -->
            <div class="inline-form" id="page-text-info">
                <fieldset>
                    <?php if (isset($text_info)): ?>
                    	<?php echo form_open_multipart(site_url('admin/home/edit_text_info/'), 'class="crud"'); ?>
                        <fieldset>
		                    <ul>
		                        <li>
		                            <label for="title">Titulo <span>*</span></label>
		                            <div class="input"><?php echo form_input('title', (isset($text_info->title)) ? $text_info->title : set_value('title'), 'class="dev-input-text" style="width:100%" maxlength="100"'); ?></div>
		                        </li>
		                        <li>
		                            <label for="name">Texto <span>*</span></label>
		                            <div class="input">
		                                <?php echo form_textarea(array('id' => 'text', 'name' => 'text', 'value' => (isset($text_info->text)) ? $text_info->text : set_value('text') , 'rows' => 8, 'maxlength' => 400, 'style' =>"width: 100%%;height: 100px")) ?>
		                            </div>
		                        </li>
		                        <li>
		                            <label for="text">Fecha <span>*</span></label>
		                            <div class="input"><?php echo form_textarea('date', (isset($text_info->date)) ? $text_info->date : set_value('date'), 'class="dev-input-title" style="width:100%" id="datepicker"'); ?></div>
		                        </li>
		                    </ul>
		                    <?php
		                    	$this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel')));
		                    ?>
		                </fieldset>
		                <?php echo form_close(); ?>
                    <?php else: ?>
                        <p style="text-align: center">No hay datos actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>
            
			<!-- slider clientes -->
            <div class="form_inputs" id="page-banner-customers">
                <fieldset>
                	<?php 
                    if(count($customers) < 20)
                    {
                    	echo anchor('admin/home/edit_customers/', '<span>+ Crear Slider Clientes</span>', 'class="btn blue"');
                    }
                    ?>
                    <br>
                    <br>
                    <?php if (!empty($customers)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 40%">Imagen</th>
                                    <th style="width: 40%">nombre</th>
                                    <th class="width-10">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="inner filtered"><?php $this->load->view('admin/partials/pagination') ?></div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($customers as $customer): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($customer->image)): ?>
                                                <img src="<?php echo site_url($customer->image); ?>" style="width: 139px;">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $customer->name ?></td>
                                        <td>
                                            <?php echo anchor('admin/home/edit_customers/' . $customer->id, lang('global:edit'), 'class="btn blue small"'); ?>
                                            <?php echo anchor('admin/home/delete_customers/' . $customer->id, lang('global:delete'), array('class' => 'btn red small confirm button')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay un slider de clientes actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>
            
        </div>
    </div>
</section>