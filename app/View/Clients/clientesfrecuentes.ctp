
<?php
    //print_r($listaProductos);
?>


<?php //echo $this->element('sql_dump'); ?>

<div class="page-header">

	<h2><?php echo __('Clientes frecuentes'); ?></h2>

</div>
	
<?php echo $this->Html->link('Exportar a Excel',array('controller'=>'clients','action'=>'exportreport7','page',
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
					echo $this->Form->input('start', array('label' => 'Inicio', 'type' => 'date', 'dateFormat' => 'DMY', 'timeFormat' => 'NULL', 'minYear' => '2016', 'maxYear' => date('Y') + 5, 'value' => $fechainicio));
					echo $this->Form->input('end', array('label' => 'Final', 'type' => 'date', 'dateFormat' => 'DMY', 'timeFormat' => 'NULL', 'minYear' => '2016', 'maxYear' => date('Y') + 5, 'value' => $fechatermino));
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
		<th><?php echo $this->Paginator->sort('first_name', 'Nombre'); ?></th>
		<th><?php echo $this->Paginator->sort('last_name', 'Apellidos'); ?></th>
		<th><?php echo $this->Paginator->sort('email', 'Email'); ?></th>
		<th><?php echo $this->Paginator->sort('created', 'Fecha agregado'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($clientes as $cliente): ?>
	<tr>
		<td><?php echo $this->Html->link(h($cliente['Client']['id']), array('controller' => 'clients', 'action' => 'view', $cliente['Client']['id'])); ?>&nbsp;</td>
		<td><?php echo h($cliente['Client']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Client']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Client']['email']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Client']['created']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>



<?php // echo $this->element('sql_dump'); ?>