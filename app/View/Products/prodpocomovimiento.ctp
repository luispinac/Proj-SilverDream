
<?php
    //print_r($listaProductos);
?>


<?php //echo $this->element('sql_dump'); ?>

<div class="page-header">

	<h2><?php echo __('Productos con poco movimiento'); ?></h2>

</div>
	
<?php echo $this->Html->link('Exportar a Excel',array('controller'=>'products','action'=>'exportreport1','page',
    '?' => array('start' => $fechainicio, 'end' => $fechatermino, 'corte' => $corte)), array('target'=>'_blank'));?>	
	
<div class="container">
	<div class="row">
	    
	    <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#filtros">Filtros</button>
		<div id="filtros" class="collapse">
			<div class="col-sm-4 text-right">
		      Filtros:  
		    </div>
			<div class="col-sm-4 text-center">
				<?php echo $this->Form->create(NULL, array('role' => 'form', 'novalidate' => 'novalidate', 'class' => 'form-inline')); ?>
				<?php
					echo $this->Form->input('start', array('label' => 'Inicio', 'type' => 'date', 'dateFormat' => 'DMY', 'timeFormat' => 'NULL', 'minYear' => date('Y') - 70, 'maxYear' => date('Y') + 18, 'value' => $fechainicio));
					echo $this->Form->input('end', array('label' => 'Final', 'type' => 'date', 'dateFormat' => 'DMY', 'timeFormat' => 'NULL', 'minYear' => date('Y') - 70, 'maxYear' => date('Y') + 18, 'value' => $fechatermino));
					echo $this->Form->input('corte', array('class' => 'form-control', 'label' => 'Cantidad a mostrar', 'value' => $corte));

				?>
			</div>
			<div class="col-sm-4">
				<?php
					echo $this->Form->end(array('label' => 'Filtrar', 'class' =>'btn btn-success'));
				?>
			</div>
		</div>
	</div>
</div>




<div class="col-md-12">

	<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('description', 'Descripción'); ?></th>
		<th><?php echo $this->Paginator->sort('Cantidad', 'Cantidad vendida'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($listaProductos as $producto): ?>
	<tr>
		<td><?php echo h($producto['Product']['id']); ?>&nbsp;</td>
		<td><?php echo h($producto['Product']['description']); ?>&nbsp;</td>
		<td><?php echo h($producto[0]['Cantidad']); ?>&nbsp;</td>
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

<?php // echo $this->element('sql_dump'); ?>