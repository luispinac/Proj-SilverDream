<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Client', array('role' => 'form', 'novalidate' => 'novalidate')); ?>
				<fieldset>
					<legend><?php echo __('Agregar Cliente'); ?></legend>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('rut', array('class' => 'form-control', 'label' => 'RUT'));
					echo $this->Form->input('first_name', array('class' => 'form-control', 'label' => 'Nombre'));
					echo $this->Form->input('last_name', array('class' => 'form-control', 'label' => 'Apellido'));
					echo $this->Form->input('email', array('class' => 'form-control', 'label' => 'E-mail'));
					echo $this->Form->input('phone', array('class' => 'form-control', 'label' => 'Teléfono'));
				?>
				</fieldset>
				<p>
				<?php echo $this->Form->end(array('label' => 'Crear Cliente', 'class' =>'btn btn-success')); ?>
				</p>
			
		</div>
	</div>
</div>

