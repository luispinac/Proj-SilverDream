<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class SalesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */
    public function isAuthorized($user)
	{
		if($user['role'] == 'seller')
		{
			if(in_array($this->action, array('index', 'view', 'add', 'add2', 'quitar', 'itemupdate', 'remove', 'recalcular')))
			{
				return true;
			}
			else
			{
				if($this->Auth->user('id'))
				{
					$this->Flash->error('Usuario no puede acceder a esta sección', array('class' => 'alert alert-danger'));
					$this->redirect($this->Auth->redirect());
				}
			}
		}
		
		return parent::isAuthorized($user);
	}
 
	public function index() {
		$this->Sale->recursive = 0;
		$this->set('sales', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		
		$res_pedidos = $this->Sale->find('all');
        
        if(count($res_pedidos) == 0)
        {
            $this->Flash->error('Aún no se han agregado items a esta venta');
            return $this->redirect(array('controller' => 'products', 'action' => 'index'));
        }
        
        
        $this->set('ventas', $this->Sale->find('all', array('order' => 'Sale.id ASC')));
        
        $total_pedidos = $this->Sale->find('all', array('fields' => array('SUM(Sale.subtotal) as subtotal')));
        $mostrar_total_pedidos = $total_pedidos[0][0]['subtotal'];
        
        $this->set('total_ventas', $mostrar_total_pedidos);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		if($this->request->is('ajax'))
        {
            $id = $this->request->data['id'];
            $cantidad = $this->request->data['cantidad'];
            
            $product = $this->Sale->Product->find('all', array('fields' => array('Product.price'), 'conditions' => array('Product.id' => $id)));
            
            $precio = $product[0]['Product']['price'];
            
            $subtotal = $cantidad * $precio;
            
            $sale = array( 'product_id' => $id, 'quantity' => $cantidad, 'subtotal' => $subtotal );
            
            $existe_pedido = $this->Sale->find( 'all', array('fields' => array('Sale.product_id'), 'conditions' => array('Sale.product_id' => $id)));
            
            if(count($existe_pedido) == 0)
            {
                $this->Sale->save($sale);
            }
        
        }
        
        $this->autoRender = false;
	}
	
	public function add2 () {
		   
		if($this->request->is('ajax'))
        {
            //$code = '';
            $code2 = $this->request->data['code'];
            $code = strval($code2);        
            //console.log($code);
           
            $cantidad = $this->request->data['cantidad'];
            
            $product = $this->Sale->Product->find('all', array('fields' => array('Product.price', 'Product.id'), 'conditions' => array('Product.code' => $code)));
            
            if(count($product) > 0)
            {
                $precio = $product[0]['Product']['price'];
                $id = $product[0]['Product']['id'];
                
                $subtotal = $cantidad * $precio;
                
                $sale = array( 'product_id' => $id, 'quantity' => $cantidad, 'subtotal' => $subtotal );
                
                $existe_pedido = $this->Sale->find( 'all', array('fields' => array('Sale.product_id'), 'conditions' => array('Sale.product_id' => $id)));
                
                if(count($existe_pedido) == 0)
                {
                    $this->Sale->save($sale);
                }
            }
            $cant_productos_encontrados = count($product);
            echo json_encode(compact('cant_productos_encontrados'));
        
        }
        
        $this->autoRender = false;
	}
	
	public function quitar()
    {
        if($this->Sale->deleteAll(1, false))
        {
            $this->Flash->success('Todos los items han sido quitados de la venta');
        }
        else
        {
            $this->Flash->error('No se pudo quitar los items de la venta');
        }
        
        return $this->redirect(array('controller' => 'products', 'action' => 'index'));
    }
	

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Venta inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Sale->save($this->request->data)) {
				$this->Flash->success(__('La venta ha sido registrada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('La venta no ha pudo ser registrada.'));
			}
		} else {
			$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
			$this->request->data = $this->Sale->find('first', $options);
		}
		$products = $this->Sale->Product->find('list');
		$this->set(compact('products'));
	}
	
	public function itemupdate()
    {
        if($this->request->is('ajax'))
        {
            $id = $this->request->data['id'];
            
            $cantidad = isset($this->request->data['cantidad']) ? $this->request->data['cantidad'] : null;
            
            if($cantidad == 0)
            {
                $cantidad = 1;
            }
            
            $item = $this->Sale->find('all', array('fields' => array('Sale.id', 'Product.price'), 'conditions' => array('Sale.id' => $id)));
            
            $precio_item = $item[0]['Product']['price'];
            
            $subtotal_item = $cantidad * $precio_item;
            
            $item_update = array('id' => $id, 'quantity' => $cantidad, 'subtotal' => $subtotal_item);
            
            $this->Sale->saveAll($item_update);
        }
        
        $total = $this->Sale->find('all', array('fields' => array('SUM(Sale.subtotal) as subtotal')));
        $mostrar_total = $total[0][0]['subtotal'];
        
        $pedido_update = $this->Sale->find('all', array('fields' => array('Sale.id', 'Sale.subtotal'), 'conditions' => array('Sale.id' => $id)));
        
        $mostrar_pedido = array('id' => $pedido_update[0]['Sale']['id'], 'subtotal' => $pedido_update[0]['Sale']['subtotal'], 'total' => $mostrar_total);
        
        echo json_encode(compact('mostrar_pedido'));
        $this->autoRender = false;
    }
    
    public function remove()
    {
        if($this->request->is('ajax'))
        {
            $id = $this->request->data['id'];
            $this->Sale->delete($id);
        }
        
        $total_remove = $this->Sale->find('all', array('fields' => array('SUM(Sale.subtotal) as subtotal')));
        $mostrar_total_remove = $total_remove[0][0]['subtotal'];
        
        $pedidos = $this->Sale->find('all');
        
        if(count($mostrar_total_remove) == 0)
        {
            $mostrar_total_remove = "0";
        }
        
        echo json_encode(compact('pedidos', 'mostrar_total_remove'));
        $this->autoRender = false;
    }
    
    public function recalcular()
    {
         debug($_POST);
        
        $arreglo = $this->request->data['Sale'];
        
        echo "<pre>";
         print_r($arreglo);
         echo "</pre>";
        
        
        if($this->request->is('post'))
        {
            foreach($arreglo as $key => $value)
            {
                $entero = preg_replace("/[^0-9]/", "", $value);
                
                if($entero == 0 || $entero == "")
                {
                    $entero = 1;
                }
                
                $precio_update = $this->Sale->find('all', array('fields' => array('Sale.id', 'Product.price'), 'conditions' => array('Sale.id' => $key)));
                
                $precio_update_mostrar = $precio_update[0]['Product']['price'];
                
                $subtotal_update = $entero * $precio_update_mostrar;
                
                $pedido_update = array('id' => $key, 'quantity' => $entero, 'subtotal' => $subtotal_update);
                $this->Sale->saveAll($pedido_update);
            }
        }
        
        if($this->request->data['recalcular'] == 'recalcular')
        {
            $this->Flash->success('Todos los pedidos fueron actualizados correctamente');
                    
            return $this->redirect(array('controller' => 'sales', 'action' => 'view'));            
        }
        elseif($this->request->data['procesar'] == 'procesar')
        {
             return $this->redirect(array('controller' => 'bills', 'action' => 'add'));  
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Venta inválida'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Sale->delete()) {
			$this->Flash->success(__('La venta ha sido eliminada.'));
		} else {
			$this->Flash->error(__('La venta no ha pudo ser eliminada.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
