
<?php
    //print_r($vendedores);
?>


<?php //echo $this->element('sql_dump'); ?>

<div class="page-header">

	<h2><?php echo __('Ventas mensuales totales'); ?></h2>

</div>
	
<?php echo $this->Html->link('Exportar a Excel',array('controller'=>'bills','action'=>'exportreport5','page',
    '?' => array('start' => $fechainicio, 'end' => $fechatermino)), array('target'=>'_blank'));?>	
	
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
		<th><?php echo $this->Paginator->sort('payment_method', 'Método de pago'); ?></th>
		<th><?php echo $this->Paginator->sort('Venta', 'Ventas'); ?></th>
		<th><?php echo $this->Paginator->sort('Cant_Ventas', 'Cantidad de ventas'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($ventas as $venta): ?>
	<tr>
		<td><?php echo h($venta['Bill']['payment_method']); ?>&nbsp;</td>
		<td><?php echo h($venta[0]['Venta']); ?>&nbsp;</td>
		<td><?php echo h($venta[0]['Cant_Ventas']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>



<?php //echo $this->element('sql_dump'); ?>