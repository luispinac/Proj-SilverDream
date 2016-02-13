<?php
// debug($ventas);
?>

<?php echo $this->Html->script(array('cart.js', 'jquery.animate-colors'), array('inline' => false)); ?>

<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'sales', 'action' => 'recalcular'))); ?>

<h1>Items en esta venta</h1>

<hr>
<div class="row">
	<div class="col col-sm-1">IMAGEN</div>
	<div class="col col-sm-7">PRODUCTO (CÓDIGO)</div>
	<div class="col col-sm-1">PRECIO</div>
	<div class="col col-sm-1">CANTIDAD</div>
	<div class="col col-sm-1">SUBTOTAL</div>
	<div class="col col-sm-1">ELIMINAR</div>
</div>

<?php $tabindex = 1; ?>

<?php foreach($ventas as $venta): ?>

	<div class="row" id="row-<?php echo $venta['Sale']['id']; ?>">
	    
		<div class="col col-sm-1">
			<figure>
				<?php echo $this->Html->image('../files/product/photo/' . $venta['Product']['photo_dir']. '/' . 'thumb_' . $venta['Product']['photo'], array('class' => 'img-pedidos')); ?>
			</figure>
		</div>

		<div class="col col-sm-7">
			<strong>
				<?php echo $this->Html->link($venta['Product']['code'], array('controller' => 'products', 'action' => 'view', $venta['Sale']['product_id'])); ?>
			</strong>
		</div>

		<div class="col col-sm-1" id="price-<?php echo $venta['Sale']['id']; ?>">
			<?php echo $venta['Product']['price']; ?>
		</div>

		<div class="col col-sm-1">
			<?php echo $this->Form->input($venta['Sale']['id'], array('div' => false, 'class' => 'numeric form-control input-small', 'label' => false, 'size' => 2, 'maxlenght' => 2, 'tabindex' => $tabindex++, 'data-id' => $venta['Sale']['id'], 'value' => $venta['Sale']['quantity'])); ?>
		</div>

		<div class="col col-sm-1" style="background-color: none;" id="subtotal_<?php echo $venta['Sale']['id']; ?>">
			<?php echo $venta['Sale']['subtotal']; ?>
		</div>

		<div class="col col-sm-1">
			<?php
			echo $this->Html->link('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', '#', array('escapeTitle' => false, 'title' => 'Eliminar item', 'id' => $venta['Sale']['id'], 'class' => 'remove'));
			?>
		</div>
	</div>
	<br />

<?php endforeach; ?>

	<hr>

<div class="row">
	<div class="col col-sm-12">
		<div class="pull-right tr">

		<?php echo $this->Html->link('Vaciar venta', array('controller' => 'sales', 'action' => 'quitar'), array('class' => 'btn btn-danger', 'confirm' => 'Está seguro de quitar todos items de esta venta?')); ?>
		
		&nbsp;&nbsp;

		<?php echo $this->Form->button('Recalcular', array('class' => 'btn btn-default', 'escape' => false, 'name' => 'recalcular', 'value' => 'recalcular')); ?>

		<br><br><br><br>
		<span class="total">Total Orden:</span>
		<span id="total" class="total">
			$ <?php echo $total_ventas; ?>
		</span>

		<br><br>
		
		<?php echo $this->Form->button('<i class="glyphicon glyphicon-arrow-right"></i> Procesar Venta', array('class' => 'btn btn-primary', 'escape' =>false, 'name' => 'procesar', 'value' => 'procesar')); ?>

		<?php echo $this->Form->end(); ?>

		</div>
	</div>
</div>
