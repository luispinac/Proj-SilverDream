<div class="clients form">
<?php echo $this->Form->create('Client'); ?>
	<fieldset>
		<legend><?php echo __('Add Client'); ?></legend>
	<?php
		echo $this->Form->input('rut');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Clients'), array('action' => 'index')); ?></li>
	</ul>
</div>