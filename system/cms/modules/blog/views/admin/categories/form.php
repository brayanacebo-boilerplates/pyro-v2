<section class="title">
	<?php if ($this->controller == 'admin_categories' && $this->method === 'edit'): ?>
	<h4><?php echo sprintf(lang('cat:edit_title'), $category->title);?></h4>
	<?php else: ?>
	<h4><?php echo lang('cat:create_title');?></h4>
	<?php endif ?>
</section>

<section class="item">
<div class="content">
<?php echo form_open($this->uri->uri_string(), 'class="crud'.((isset($mode)) ? ' '.$mode : '').'" id="categories"') ?>

<div class="form_inputs">
	<div class="inline-form">
    	<fieldset>
            <ul>
                <li class="even">
                    <label for="title"><?php echo lang('global:title');?> <span>*</span></label>
                    <div class="input"><?php echo  form_input('title', $category->title) ?></div>
                    <br class="clear">
                </li>
                <li>
                    <label for="slug"><?php echo lang('global:slug') ?> <span>*</span></label>
                    <div class="input"><?php echo  form_input('slug', $category->slug) ?></div>
                    <?php echo  form_hidden('id', $category->id) ?>
                    <br class="clear">
                </li>
            </ul>
    	</fieldset>
    </div>

</div>

	<div><?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )) ?></div>

<?php echo form_close() ?>
</div>
</section>