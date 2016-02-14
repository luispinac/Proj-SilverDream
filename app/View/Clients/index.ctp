<div class="page-header">

	<h2><?php echo __('Clientes'); ?></h2>

</div>

<div class="col-md-12">

	<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('rut', 'RUT'); ?></th>
		<th><?php echo $this->Paginator->sort('first_name', 'Nombre'); ?></th>
		<th><?php echo $this->Paginator->sort('last_name', 'Apellidos'); ?></th>
		<th><?php echo $this->Paginator->sort('email', 'E-mail'); ?></th>
		<th><?php echo $this->Paginator->sort('phone', 'Teléfono'); ?></th>
		<th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
		<th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($clients as $client): ?>
	<tr>
		<td><?php echo h($client['Client']['id']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['rut']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['email']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['phone']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['created']); ?>&nbsp;</td>
		<td><?php echo h($client['Client']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $client['Client']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $client['Client']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $client['Client']['id']), array('confirm' => __('Está seguro que quiere eliminar al cliente %s?', $client['Client']['first_name'] . " " . $client['Client']['last_name'] ))); ?>
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