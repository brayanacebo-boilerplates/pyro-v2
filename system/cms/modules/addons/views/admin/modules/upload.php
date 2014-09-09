<section class="title">
	<h4><?php echo lang('addons:modules:upload_title');?></h4>
</section>

<section class="item">
<div class="content">
<?php echo form_open_multipart('admin/addons/modules/upload', array('class' => 'crud'));?>
	<div class="inline-form">
		<fieldset>
            <ul>
                <li>
                    <label for="userfile"><?php echo lang('addons:modules:upload_desc');?></label><br/>
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
	
	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('upload') )) ?>
	</div>
<?php echo form_close() ?>
</div>
</section>
