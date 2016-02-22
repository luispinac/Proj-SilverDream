<?php
   $this->Paginator->options(array(
      'update' => '#contenedor-productos',
      'before' => $this->Js->get("#procesando")->effect('fadeIn', array('buffer' => false)),
      'complete' => $this->Js->get("#procesando")->effect('fadeOut', array('buffer' => false))
   ));
?>

<div id="contenedor-productos">

	<div class="progress oculto" id="procesando">
	  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	    <span class="sr-only">100% Complete</span>
	  </div>
	</div>

	<div class="page-header">
		<div class="row">
	  		<div class="col-sm-8"><h2><?php echo __('Productos'); ?></h2></div>
	  		<div class="col-sm-4 text-right">Hola <?php echo $usuario; ?></div>
		</div>
	</div>
	 

	<div class="row">
		<?php foreach ($products as $product): ?>
		<div class="col col-sm-3">
			<figure class="product">
				<?php echo $this->Html->image('../files/product/photo/' . $product['Product']['photo_dir'] . '/' . 'thumb_' .$product['Product']['photo'], array('url' => array('controller' => 'products', 'action' => 'view', $product['Product']['id']))); ?>
			</figure>
			<br />
			<?php 
			if($product['Product']['stock']==0){
				echo $this->Html->link($product['Product']['code'] . ' (**SIN STOCK**)', array('action' => 'view', $product['Product']['id']), array('class' => 'sin-stock')); 
			}else{
				echo $this->Html->link($product['Product']['code'], array('action' => 'view', $product['Product']['id']));
			}
			
			?>
			<br />
			<span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>
			<?php echo $this->Html->link($product['Category']['category_name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id']), array('class' => 'food-category')); ?>
			<br />
			$ <?php echo h($product['Product']['price']); ?>&nbsp;
			<br />
			<br />
		</div>
		<?php endforeach; ?>
	</div>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, comenzando en el registro {:start}, finalizando en el {:end}')
		));
		?>	</p>
		<ul class="pagination">
			<li> <?php echo $this->Paginator->prev('< ' . __('anterior'), array('tag' => false), null, array('class' => 'prev disabled')); ?> </li>
			<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
			<li> <?php echo $this->Paginator->next(__('siguiente') . ' >', array('tag' => false), null, array('class' => 'next disabled')); ?> </li>
		</ul>
	<?php echo $this->Js->writeBuffer(); ?>
</div> <!-- contenedor-productos -->