<div class="sellers form">
<?php echo $this->Form->create('Seller'); ?>
	<fieldset>
		<legend><?php echo __('Edit Seller'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('rut');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Seller.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Seller.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('action' => 'index')); ?></li>
	</ul>
</div>
