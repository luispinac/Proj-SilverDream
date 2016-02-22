
<?php
    //print_r($listaProductos);
?>


<?php //echo $this->element('sql_dump'); ?>

<div class="page-header">

	<h2><?php echo __('Productos más vendidos'); ?></h2>

</div>
	
<?php echo $this->Html->link('Exportar a Excel',array('controller'=>'products','action'=>'exportreport3','page',
    '?' => array('start' => $fechainicio, 'end' => $fechatermino, 'corte' => $corte)), array('target'=>'_blank'));?>	
	
<div class="container">
	<div class="row">
	    
	    <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#filtros">Filtros</button>
		<div id="filtros" class="collapse">
			<div class="col-sm-4 text-right">
		    
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
		<th><?php echo 'Nro'; ?></th>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('code', 'Código'); ?></th>
		<th><?php echo $this->Paginator->sort('description', 'Descripción'); ?></th>
		<th><?php echo $this->Paginator->sort('suma', 'Suma'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php $i=1;
	foreach ($listaProductos as $producto): ?>
	<tr>
		<td><?php echo $i; $i++; ?>&nbsp;</td>
		<td><?php echo h($producto['Product']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link(h($producto['Product']['code']), array('controller' => 'products', 'action' => 'view', $producto['Product']['id'])); ?>&nbsp;</td>
		<td><?php echo h($producto['Product']['description']); ?>&nbsp;</td>
		<td><?php echo h($producto[0]['Suma']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>



<?php // echo $this->element('sql_dump'); ?>