<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Seller', array('type' => 'file', 'novalidate' => 'novalidate' )); ?>
				<fieldset>
					<legend><?php echo __('Editar Vendedor'); ?></legend>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('rut', array('class' => 'form-control', 'label' => 'RUT'));
					echo $this->Form->input('first_name', array('class' => 'form-control', 'label' => 'Nombre'));
					echo $this->Form->input('last_name', array('class' => 'form-control', 'label' => 'Apellidos'));
				?>
				</fieldset>
				<p>
					<?php echo $this->Form->end(array('label' => 'Editar Vendedor', 'class' =>'btn btn-success')); ?>
				</p>
		</div>
	</div>
</div>

