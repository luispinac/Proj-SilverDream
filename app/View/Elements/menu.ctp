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

            <?php //if($current_user['role'] == 'admin'): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista Usuarios', array('controller' => 'users', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Usuario', array('controller' => 'users', 'action' => 'add')) ?></li>
                <li class="divider"></li>
                <li class="dropdown-header">Vendedores</li>
                <li><?php echo $this->Html->link('Lista Vendedores', array('controller' => 'sellers', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Vendedor', array('controller' => 'sellers', 'action' => 'add')) ?></li>                   

              </ul>
            </li>
            <?php //endif; ?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista Clientes', array('controller' => 'clients', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Cliente', array('controller' => 'clients', 'action' => 'add')) ?></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista Productos', array('controller' => 'products', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Lista Productos detallada', array('controller' => 'products', 'action' => 'index2')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Producto', array('controller' => 'products', 'action' => 'add')) ?></li>
                <li><?php echo $this->Html->link('Buscar Producto', array('controller' => 'products', 'action' => 'search')) ?></li>
                <li class="divider"></li>
                <li class="dropdown-header">Categorías</li>
                <li><?php echo $this->Html->link('Lista Categorías', array('controller' => 'categories', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nueva Categoría', array('controller' => 'categories', 'action' => 'add')) ?></li>                   
              </ul>
            </li>
            
            <?php //if($current_user['role'] == 'admin'): ?>
            <li><?php echo $this->Html->link('Lista de Órdenes', array('controller' => 'ordens', 'action' => 'index')); ?></li>
            <?php //endif; ?>
          </ul>
          
          <?php echo $this->Form->create('Platillo', array('type' => 'GET', 'class' => 'navbar-form navbar-left', 'url' => array('controller' => 'platillos', 'action' => 'search'))); ?>
          <div class="form-group">
              <?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'id' => 's', 'class' => 'form-control s', 'autocomplete' => 'off', 'placeholder' => 'Buscar producto...')); ?>
          </div>
          <?php echo $this->Form->button('Buscar', array('div' => false, 'class' => 'btn btn-primary')); ?>
          <?php echo $this->Form->end(); ?>
          
          <?php echo $this->Html->link('Venta', array('controller' => 'sales', 'action' => 'view'), array('class' => 'btn btn-success navbar-btn') ); ?>
          
            <ul class="nav navbar-nav navbar-right">
              <li>
                <?php echo $this->Html->link('Salir', array('controller' => 'users', 'action' => 'logout')); ?>
              </li>
            </ul>          
          
        </div><!--/.nav-collapse -->
      </div>
    </div>