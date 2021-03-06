	<h1>Código: <?php echo $product['Product']['code']; ?></h1>

<div class="row">

	<div class="col col-sm-7">
			<?php echo $this->Html->image('../files/product/photo/' . $product['Product']['photo_dir'] . '/' . 'vga_' .$product['Product']['photo'], array('class' => 'img-thumbnail img-responsive')); ?>
	</div>

	<div class="col col-sm-5">

		<strong> Código: <?php echo $product['Product']['code']; ?></strong>

		<br />
		<br />

		$ <span id="productprice"><?php echo h($product['Product']['price']); ?></span>

		<br />
		<br />

		<?php echo $this->Form->button('Agregar a la venta', array('class' => 'btn btn-primary addtocart', 'id' => $product['Product']['id']) ); ?>

		<br />
		<br />


		Descripción: <?php echo h($product['Product']['description']); ?>

		<br />
		<br />
		
		Stock: <?php echo h($product['Product']['stock']); ?>

		<br />
		<br />
		
		Stock crítico: <?php echo h($product['Product']['critical_stock']); ?>

		<br />
		<br />
		
		Tipo: <?php echo h($product['Product']['product_type']); ?>

		<br />
		<br />

		Creado: <?php echo $product['Product']['created']; ?>

		<br />
		<br />

		Modificado: <?php echo $product['Product']['modified']; ?>
		<br />
		<br />

		Categoría: <?php echo $this->Html->link($product['Category']['category_name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
		<br />
		<br />
		<?php if($current_user['role'] == 'admin'): ?>
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		    <?php echo __('Acciones'); ?> <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu">
			<li><?php echo $this->Html->link(__('Editar Producto'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Eliminar Producto'), array('action' => 'delete', $product['Product']['id']), array(), __('Está seguro que desea eliminar el producto con código %s?', $product['Product']['code'])); ?> </li>
			<li><?php echo $this->Html->link(__('Listar Productos'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Nuevo Producto'), array('action' => 'add')); ?> </li>
		    <li class="divider"></li>
			<li><?php echo $this->Html->link(__('Lista de Categorías'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Nueva Categoría'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		  </ul>
		</div>
		<?php endif; ?>

	</div>

</div>
