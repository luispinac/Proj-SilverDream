<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Product', array('novalidate' => 'novalidate' )); ?>
				<fieldset>
					<legend><?php echo __('Agregar stock de productos'); ?></legend>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('code', array('class' => 'form-control', 'label' => 'Código'));
					echo $this->Form->input('stock', array('class' => 'form-control', 'label' => 'Stock'));
				?>
				</fieldset>
				<p>
					<?php echo $this->Form->end(array('label' => 'Agregar stock', 'class' =>'btn btn-success')); ?>
				</p>
		</div>
	</div>
</div>

