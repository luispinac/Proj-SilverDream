<div class="page-header">

	<h2><?php echo __('Vendedores'); ?></h2>

</div>

<div class="col-md-12">

	<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('rut', 'RUT'); ?></th>
		<th><?php echo $this->Paginator->sort('first_name', 'Nombre'); ?></th>
		<th><?php echo $this->Paginator->sort('last_name', 'Apellidos'); ?></th>
		<th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
		<th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($sellers as $seller): ?>
	<tr>
		<td><?php echo h($seller['Seller']['id']); ?>&nbsp;</td>
		<td><?php echo h($seller['Seller']['rut']); ?>&nbsp;</td>
		<td><?php echo h($seller['Seller']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($seller['Seller']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($seller['Seller']['created']); ?>&nbsp;</td>
		<td><?php echo h($seller['Seller']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $seller['Seller']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $seller['Seller']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $seller['Seller']['id']), array('confirm' => __('Estás seguro que deseas eliminar el vendedor %s?', $seller['Seller']['first_name'] . " " . $seller['Seller']['last_name']))); ?>
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