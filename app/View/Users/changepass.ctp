<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('User', array('novalidate' => 'novalidate' )); ?>
				<fieldset>
					<legend><?php echo __('Cambiar contraseña de usuario'); ?></legend>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('password', array('class' => 'form-control', 'label' => 'Contraseña', 'placeholder' => 'Ingrese contraseña', 'value' => ''));
				?>
				</fieldset>
				<p>
					<?php echo $this->Form->end(array('label' => 'Cambiar contraseña', 'class' =>'btn btn-success')); ?>
				</p>
		</div>
	</div>
</div>

