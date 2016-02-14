<div class="container">
	<div class="row">
		<div class="col-md-6">
            <?php echo $this->Form->create('Bill', array('role'=> 'form')); ?>
			<fieldset>
				<h2>Finalizar venta</h2>
                <?php
                	echo $this->Form->input('bill_number', array('class' => 'form-control', 'label' => 'Número de boleta'));
                	echo $this->Form->input('payment_method', array('class' => 'form-control', 'label' => 'Método de pago', 'type' => 'select', 'options' => array('Efectivo' => 'Efectivo', 'Transbank' => 'Transbank')));
                    //echo $this->Form->input('user_id', array('class' => 'form-control', 'label' => 'Vendedor'));
                ?>
			</fieldset>
			<h3>Productos: </h3>
			<table class="table table-striped">
			<thead>
			<tr>
				<th>Código</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Subtotal</th>
			</tr>
			</thead>
			<tbody>
            <?php foreach($orden_item as $item): ?>
			<tr>
				<td><?php echo $item['Product']['code']; ?></td>
				<td><?php echo $item['Product']['price']; ?></td>
				<td><?php echo $item['Sale']['quantity']; ?></td>
				<td><?php echo $item['Sale']['subtotal']; ?></td>
			</tr>
            <?php endforeach; ?>
			</tbody>
			</table>
			<p>
				<span class="total">Total Venta:</span>
				<span id="total" class="total">
					$ <?php echo $mostrar_total_pedidos; ?>
				</span>
				<br />
				<br />
                <?php echo $this->Form->input('total',array('type' => 'hidden', 'value' => $mostrar_total_pedidos)); ?>
                <?php echo $this->Form->end(array('label' => 'Finalizar venta', 'class' => 'btn btn-success')); ?>
				
			</p>
		</div>
	</div>
</div>
