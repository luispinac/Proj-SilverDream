<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Category', array('type' => 'file', 'novalidate' => 'novalidate' )); ?>
				<fieldset>
					<legend><?php echo __('Editar Categoría'); ?></legend>
				<?php
					echo $this->Form->input('category_name', array('class' => 'form-control', 'label' => 'Categoría'));
				?>
				</fieldset>
				<p>
					<?php echo $this->Form->end(array('label' => 'Editar Categoría', 'class' =>'btn btn-success')); ?>
				</p>
		</div>
	</div>
</div>

