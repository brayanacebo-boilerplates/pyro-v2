<section class="title">
    
    <h4><?php echo lang('nav:group_create_title');?></h4>
    
</section>

<section class="item">
	<div class="content">

    <?php echo form_open('admin/navigation/groups/create', 'class="crud"') ?>

		<div class="form_inputs">
			<div class="inline-form">
            	<fieldset>
                    <ul>
                        <li class="even">
                            <label for="title"><?php echo lang('global:title');?> <span>*</span></label>
                            <div class="input"><?php echo form_input('title', $navigation_group['title'], 'class="text"') ?></div>
                            <br class="clear">
                        </li>
                    
                        <li>
                            <label for="url"><?php echo lang('global:slug');?> <span>*</span></label>
                            <div class="input"><?php echo form_input('abbrev', $navigation_group['abbrev'], 'class="text"') ?></div>
                            <br class="clear">
                        </li>
                    </ul>
            	</fieldset>
            </div>
		
		</div>
	    
    <div class="buttons padding-top">       
	    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )) ?>
    </div>
        
    <?php echo form_close() ?>
	
	</div>
</section>
    
