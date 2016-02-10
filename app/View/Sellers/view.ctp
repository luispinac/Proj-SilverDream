<div class="sellers view">
<h2><?php echo __('Seller'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rut'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['rut']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Seller'), array('action' => 'edit', $seller['Seller']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Seller'), array('action' => 'delete', $seller['Seller']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $seller['Seller']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('action' => 'add')); ?> </li>
	</ul>
</div>
