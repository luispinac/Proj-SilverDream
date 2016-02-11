<div class="page-header">

	<h2><?php echo __('Productos'); ?></h2>

</div>

<div class="col-md-12">

	<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('code', 'Código'); ?></th>
		<th><?php echo $this->Paginator->sort('description', 'Descripción'); ?></th>
		<th><?php echo $this->Paginator->sort('price', 'Precio'); ?></th>
		<th><?php echo $this->Paginator->sort('stock', 'Stock'); ?></th>
		<th><?php echo $this->Paginator->sort('critical_stock', 'Stock crítico'); ?></th>
		<th><?php echo $this->Paginator->sort('type', 'Tipo'); ?></th>
		<th><?php echo $this->Paginator->sort('photo', 'Foto'); ?></th>
		<th><?php echo $this->Paginator->sort('photo_dir', 'Foto dir'); ?></th>
		<th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
		<th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
		<th><?php echo $this->Paginator->sort('category_id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['code']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['description']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['price']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['stock']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['critical_stock']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['type']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['photo']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['photo_dir']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['created']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($product['Category']['category_name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?>
		</td>
		
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, comenzando en el registro {:start}, finalizando en el {:end}')
	));
	?>	</p>
<nav>
	<ul class="pagination">
		<li> <?php echo $this->Paginator->prev('< ' . __('anterior'), array('tag' => false), null, array('class' => 'prev disabled')); ?> </li>
		<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
		<li> <?php echo $this->Paginator->next(__('siguiente') . ' >', array('tag' => false), null, array('class' => 'next disabled')); ?> </li>
	</ul>
</nav>