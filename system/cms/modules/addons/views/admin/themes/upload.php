<section class="title">
	<h4><?php echo lang('addons:themes:upload_title');?></h4>
</section>

<section class="item">
	<div class="content">
	
		<?php echo form_open_multipart('admin/addons/themes/upload', array('class' => 'crud')) ?>
		<div class="inline-form">
        	<fieldset>
                <ul>
                    <li>
                        <label><?php echo lang('addons:themes:upload_desc') ?></label>
                        <div class="input">
                            <div class="btn-false">
                                <div class="btn blue">Examinar</div>
                                <input type="file" name="userfile" class="input" />
                            </div>
                        </div>
                        <br class="clear">
                    </li>
                </ul>
            </fieldset>
        </div>
			
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('upload'))) ?>
			
		<?php echo form_close() ?>
	
	</div>
</section>