<?php //echo $this->Html->script( array('addtocart.js'), array('inline' => false) ); ?>	
<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php //echo $this->Html->link('Silver Dream', array('controller' => 'users', 'action' => 'platillos'), array('class' => 'navbar-brand' )); ?>
          <?php echo $this->Html->image('../img/logoSD.png', array('height' => 45)); ?>

        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

           <?php $idUsuarioActual = $current_user['id']; ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                 <?php if($current_user['role'] == 'admin'): ?>
                <li><?php echo $this->Html->link('Lista Usuarios', array('controller' => 'users', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Usuario', array('controller' => 'users', 'action' => 'add')) ?></li>
                 <?php endif; ?>
                <li><?php echo $this->Html->link('Cambiar contraseña', array('controller' => 'users', 'action' => 'changepass', $idUsuarioActual)) ?></li>
                <li class="divider"></li>
               
                <li class="dropdown-header">Cliente</li>
                <li><?php echo $this->Html->link('Lista Clientes', array('controller' => 'clients', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Cliente', array('controller' => 'clients', 'action' => 'add')) ?></li>

              </ul>
            </li>
            

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista Productos', array('controller' => 'products', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Lista Productos detallada', array('controller' => 'products', 'action' => 'index2')) ?></li>
                <?php if($current_user['role'] == 'admin'): ?>
                <li><?php echo $this->Html->link('Nuevo Producto', array('controller' => 'products', 'action' => 'add')) ?></li>
                 <li><?php echo $this->Html->link('Agregar Stock', array('controller' => 'products', 'action' => 'addstock')) ?></li>
                <?php endif; ?>
                <li><?php echo $this->Html->link('Buscar Producto', array('controller' => 'products', 'action' => 'search')) ?></li>
                <li class="divider"></li>
                <li class="dropdown-header">Categorías</li>
                <li><?php echo $this->Html->link('Lista Categorías', array('controller' => 'categories', 'action' => 'index')) ?></li>
                <?php if($current_user['role'] == 'admin'): ?>
                <li><?php echo $this->Html->link('Nueva Categoría', array('controller' => 'categories', 'action' => 'add')) ?></li>     
                <?php endif; ?>
              </ul>
            </li>
            
            <?php if($current_user['role'] == 'admin'): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista de ventas', array('controller' => 'bills', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Productos con poco movimiento', array('controller' => 'products', 'action' => 'prodpocomovimiento')) ?></li>
                <li><?php echo $this->Html->link('Productos con stock crítico', array('controller' => 'products', 'action' => 'prodstockcritico')) ?></li>
                <li><?php echo $this->Html->link('Productos más vendidos', array('controller' => 'products', 'action' => 'prodmasvendidos')) ?></li>
                <li><?php echo $this->Html->link('Ventas por vendedor', array('controller' => 'bills', 'action' => 'ventasporvendedor')) ?></li>
                <li><?php echo $this->Html->link('Ventas mensuales totales', array('controller' => 'bills', 'action' => 'ventasmensuales')) ?></li>
                <li><?php echo $this->Html->link('Detalle de ventas por producto', array('controller' => 'products', 'action' => 'ventasporproducto')) ?></li>
                <li><?php echo $this->Html->link('Clientes frecuentes', array('controller' => 'clients', 'action' => 'clientesfrecuentes')) ?></li>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
          
          <?php echo $this->Form->create('Product', array('type' => 'GET', 'class' => 'navbar-form navbar-left', 'url' => array('controller' => 'products', 'action' => 'search'))); ?>
          <div class="form-group">
              <?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'id' => 's', 'class' => 'form-control s', 'autocomplete' => 'off', 'placeholder' => 'Buscar productos...')); ?>
          </div>
          <?php echo $this->Form->button('Buscar', array('div' => false, 'class' => 'btn btn-default')); ?>
          <?php echo $this->Form->end(); ?>
          <?php echo $this->Form->button('Agregar a la venta', array('div' => false, 'class' => 'btn btn-default addtocart2')); ?>
          <?php echo $this->Html->link(' Venta', array('controller' => 'sales', 'action' => 'view'), array('class' => 'btn btn-success navbar-btn glyphicon glyphicon-shopping-cart') ); ?>
          
            <ul class="nav navbar-nav navbar-right">
              <li>
                <?php echo $this->Html->link('Salir', array('controller' => 'users', 'action' => 'logout')); ?>
              </li>
            </ul>          
          
        </div><!--/.nav-collapse -->
      </div>
    </div>