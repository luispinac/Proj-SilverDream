<div class="page-header">

	<h2><?php echo __('Usuarios'); ?></h2>

</div>

<div class="col-md-12">

	<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('fullname', 'Nombre'); ?></th>
		<th><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
		<th><?php echo $this->Paginator->sort('password', 'Contraseña'); ?></th>
		<th><?php echo $this->Paginator->sort('role', 'Rol'); ?></th>
		<th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
		<th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['fullname']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Está seguro que quiere eliminar al usuario %s?', $user['User']['username']))); ?>
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