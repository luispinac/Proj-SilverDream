<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Seller', array('role' => 'form', 'novalidate' => 'novalidate')); ?>
				<fieldset>
					<legend><?php echo __('Agregar Vendedor'); ?></legend>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('rut', array('class' => 'form-control', 'label' => 'RUT'));
					echo $this->Form->input('first_name', array('class' => 'form-control', 'label' => 'Nombre'));
					echo $this->Form->input('last_name', array('class' => 'form-control', 'label' => 'Apellido'));
				?>
				</fieldset>
				<p>
				<?php echo $this->Form->end(array('label' => 'Crear Vendedor', 'class' =>'btn btn-success')); ?>
				</p>
			
		</div>
	</div>
</div>

