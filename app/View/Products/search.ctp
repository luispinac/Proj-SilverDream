<?php if($ajax != 1): ?>

    <h1>Buscar producto</h1>
    <br>
    <div class="row">
        <?php echo $this->Form->create('Product', array('type' => 'GET')); ?>
        
        <div class="col-sm-4">
            <?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'class' => 'form-control', 'autocomplet' => 'off', 'value' => $search)); ?>
        </div>
        
  
        
        <div class="col-sm-3">
           <?php echo $this->Form->button('Buscar', array('div' => false, 'class' => 'btn btn-primary')); ?>
        </div>
        
        <?php echo $this->Form->end(); ?>
        
    </div>

    <br><br>
<?php endif; ?>

<?php if(!empty($search)): ?>

    <?php if(!empty($products)): ?>
    
    <div class="row">
        <?php foreach($products as $product): ?>
            <div class="col-sm-3">
                <figure class="product">
                    <?php echo $this->Html->image('../files/platillo/foto/' . $product['Product']['photo_dir'] . '/' . 'thumb_' . $product['Product']['photo'], array('url' => array('controller' => 'product', 'action' => 'view', $product['Product']['id']))); ?>
                </figure>
                <br>
                <?php echo $this->Html->link($product['Product']['code'], array('action' => 'view', $product['Product']['id'])); ?>
                <br>
                $ <?php echo $product['Product']['price'] ;?>
                <br><br>
            </div>
        <?php endforeach; ?>
    </div>
    <br><br><br>
    
    <?php else: ?>
    
    <h3>No se encontró el producto que busca :-( </h3>
    
    <?php endif; ?>

<?php endif; ?>