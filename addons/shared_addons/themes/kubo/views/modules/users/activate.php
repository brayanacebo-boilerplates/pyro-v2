<style type="text/css">
input[type=submit]{
	padding:6px 12px !important;
}
</style>
<div class="container_body">
<br />
<div class="well row-fluid form_pro">
<h2 class="page-title" id="page_title"><?php echo lang('user:register_header') ?></h2>

<div class="workflow_steps">
	<span id="active_step"><?php echo lang('user:register_step1') ?></span> &gt;
	<span><?php echo lang('user:register_step2') ?></span>
</div>

<?php if(!empty($error_string)): ?>
<div class="error-box">
	<?php echo $error_string ?>
</div>
<?php endif;?>
<br />
<?php echo form_open('users/activate', 'id="activate-user"') ?>

		<label for="email"><?php echo lang('global:email') ?></label><br />
		<?php echo form_input('email', isset($_user['email']) ? $_user['email'] : '', 'maxlength="40"');?>
        <br /><br />
		<label for="activation_code"><?php echo lang('user:activation_code') ?></label><br />
		<?php echo form_input('activation_code', '', 'maxlength="40"');?>
        <br /><br />        
		<?php echo form_submit('btnSubmit', lang('user:activate_btn')) ?>
        
<?php echo form_close() ?>
</div>
</div>