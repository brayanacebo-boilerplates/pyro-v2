<?php if ($this->session->flashdata('error')): ?>
<script>
$(document).ready(function() {
    console.log('slfkjgbkfdhg');
});
</script>
<?php endif; ?>

<?php if (validation_errors()): ?>
<div class="alert error animated fadeIn">
	<p><?php echo validation_errors(); ?></p>
</div>
<?php endif; ?>

<?php if ( ! empty($messages['error'])): ?>
<div class="alert error animated fadeIn">
	<p><?php echo $messages['error']; ?></p>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('notice')): ?>
<div class="alert warning animated fadeIn">
	<p><?php echo $this->session->flashdata('notice');?></p>
</div>
<?php endif; ?>

<?php if ( ! empty($messages['notice'])): ?>
<div class="alert warning animated fadeIn">
	<p><?php echo $messages['notice']; ?></p>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
<script>
$(document).ready(function() {
    $.gritter.add({
        title: 'Notificación del sistema',
        text: '<?php echo $this->session->flashdata('success'); ?>'
    });
    return false;
});
</script>
<?php endif; ?>

<?php if ( ! empty($messages['success'])): ?>
<div class="alert success animated fadeIn">
	<p><?php echo $messages['success']; ?></p>
</div>
<?php endif; ?>

<?php 

	/**
	 * Admin Notification Event
	 */
	Events::trigger('admin_notification');
	
?>