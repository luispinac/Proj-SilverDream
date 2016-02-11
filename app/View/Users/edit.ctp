<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('User', array('type' => 'file', 'novalidate' => 'novalidate' )); ?>
				<fieldset>
					<legend><?php echo __('Editar usuarios'); ?></legend>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('fullname', array('class' => 'form-control', 'label' => 'Nombre'));
					echo $this->Form->input('username', array('class' => 'form-control', 'label' => 'Username'));
					echo $this->Form->input('role', array('class' => 'form-control', 'label' => 'Rol', 'type' => 'select', 'options' => array('admin' => 'Administrador', 'user' => 'Usuario')));
				?>
				</fieldset>
				<p>
					<?php echo $this->Form->end(array('label' => 'Editar Usuario', 'class' =>'btn btn-success')); ?>
				</p>
		</div>
	</div>
</div>

