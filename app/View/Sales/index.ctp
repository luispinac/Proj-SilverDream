<div class="sales index">
	<h2><?php echo __('Sales'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('subtotal'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($sales as $sale): ?>
	<tr>
		<td><?php echo h($sale['Sale']['id']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['quantity']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['subtotal']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['created']); ?>&nbsp;</td>
		<td><?php echo h($sale['Sale']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sale['Product']['name'], array('controller' => 'products', 'action' => 'view', $sale['Product']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sale['Sale']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sale['Sale']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sale['Sale']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $sale['Sale']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Sale'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
