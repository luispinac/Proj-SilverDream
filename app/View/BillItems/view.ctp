<?php
   $this->Paginator->options(array(
      'update' => '#contenedor-ordens',
      'before' => $this->Js->get("#procesando")->effect('fadeIn', array('buffer' => false)),
      'complete' => $this->Js->get("#procesando")->effect('fadeOut', array('buffer' => false))
   ));
?>

<div id="contenedor-ordens">

<div class="page-header">

	<h2>Items de la venta <?php echo $billitems[0]['Bill']['bill_number']; ?></h2>

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
				<th><?php echo $this->Paginator->sort('Producto'); ?></th>
				<th><?php echo $this->Paginator->sort('Cantidad'); ?></th>
				<th><?php echo $this->Paginator->sort('Subtotal'); ?> $</th>
		</tr>
		</thead>
		<tbody>
        <?php foreach($billitems as $billitem): ?>
		<tr>
			<td><?php echo h($billitem['Product']['code']); ?></td>
			<td><?php echo h($billitem['BillItem']['quantity']); ?></td>
			<td><?php echo h($billitem['BillItem']['subtotal']); ?></td>
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