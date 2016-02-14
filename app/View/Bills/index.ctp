<?php
   $this->Paginator->options(array(
      'update' => '#contenedor-ordens',
      'before' => $this->Js->get("#procesando")->effect('fadeIn', array('buffer' => false)),
      'complete' => $this->Js->get("#procesando")->effect('fadeOut', array('buffer' => false))
   ));
?>

<?php if(empty($bills)): ?>

<h2>No existen boletas disponibles</h2>

<?php else: ?>

<div id="contenedor-ordens">

<div class="page-header">

	<h2><?php echo __('Boletas'); ?></h2>

</div>

	<div class="col-md-12">

	<div class="progress oculto" id="procesando">
	  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	    <span class="sr-only">100% Complete</span>
	  </div>
	</div>


		<table class="table table-striped">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('Vendedor'); ?></th>
				<th><?php echo $this->Paginator->sort('Número boleta'); ?></th>
				<th><?php echo $this->Paginator->sort('Método de pago'); ?></th>
				<th><?php echo $this->Paginator->sort('Total'); ?> $</th>
				<th><?php echo $this->Paginator->sort('Creado'); ?></th>
				<th><?php echo $this->Paginator->sort('Modificado'); ?></th>
				<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		</thead>
		<tbody>

        <?php foreach($bills as $bill): ?>
		
		<tr>
			<td><?php echo h($bill['User']['fullname']); ?></td>
			<td><?php echo h($bill['Bill']['bill_number']); ?></td>
			<td><?php echo h($bill['Bill']['payment_method']); ?></td>
			<td><?php echo h($bill['Bill']['total']); ?></td>
			<td><?php echo $this->Time->format('d-m-Y h:i A', h($bill['Bill']['created'])); ?></td>
			<td><?php echo $this->Time->format('d-m-Y h:i A', h($bill['Bill']['modified'])); ?></td>
			<td class="actions">
				<?php 
				    echo $this->Html->link('Ver productos', array('controller' => 'bill_items', 'action' => 'view', $bill['Bill']['id']), array('class' => 'btn btn-sm btn-info'));
				?>
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
		<ul class="pagination">
			<li> <?php echo $this->Paginator->prev('< ' . __('Anterior'), array('tag' => false), null, array('class' => 'prev disabled')); ?> </li>
			<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
			<li> <?php echo $this->Paginator->next(__('Siguiente') . ' >', array('tag' => false), null, array('class' => 'next disabled')); ?> </li>
		</ul>
	<?php echo $this->Js->writeBuffer(); ?>
</div> <!-- contenedor-ordens -->

<?php endif; ?>