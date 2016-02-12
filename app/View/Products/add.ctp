<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Product', array('type' => 'file',  'novalidate' => 'novalidate')); ?>
				<fieldset>
					<legend><?php echo __('Agregar Producto'); ?></legend>
				<?php
					echo $this->Form->input('code', array('class' => 'form-control', 'label' => 'Código'));
					echo $this->Form->input('description', array('class' => 'form-control', 'label' => 'Descripción'));
					echo $this->Form->input('price', array('class' => 'form-control', 'label' => 'Precio'));
					echo $this->Form->input('stock', array('class' => 'form-control', 'label' => 'Stock'));
					echo $this->Form->input('critical_stock', array('class' => 'form-control', 'label' => 'Stock crítico'));
					echo $this->Form->input('product_type', array('class' => 'form-control', 'label' => 'Tipo', 'type' => 'select', 'options' => array('unico' => 'Único', 'recurrente' => 'Recurrente')));
					echo $this->Form->input('photo', array('type' => 'file', 'label' => 'Foto', 'id' => 'photo', 'class' => 'file', 'data-show-upload' => 'false', 'data-show-caption' => 'true'));
					echo $this->Form->input('photo_dir', array('type' => 'hidden'));
					echo $this->Form->input('category_id', array('class' => 'form-control', 'label' => 'category_id'));
				?>
				</fieldset>
				<p>
				<?php echo $this->Form->end(array('label' => 'Crear Producto', 'class' =>'btn btn-success')); ?>
				</p>
			
		</div>
	</div>
</div>


