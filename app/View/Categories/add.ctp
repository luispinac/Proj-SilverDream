<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Category', array('role' => 'form', 'novalidate' => 'novalidate')); ?>
				<fieldset>
					<legend><?php echo __('Agregar Categoría'); ?></legend>
				<?php
					echo $this->Form->input('category_name', array('class' => 'form-control', 'label' => 'Nombre de categoría'));
				?>
				</fieldset>
				<p>
				<?php echo $this->Form->end(array('label' => 'Crear Categoría', 'class' =>'btn btn-success')); ?>
				</p>
			
		</div>
	</div>
</div>



