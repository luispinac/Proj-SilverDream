<?php
App::uses('AppController', 'Controller');
/**
 * Bills Controller
 *
 * @property Bill $Bill
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class BillsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	var $helpers = array('Html', 'Form','Csv');

/**
 * index method
 *
 * @return void
 */
 	public function isAuthorized($user)
	{
		if($user['role'] == 'seller')
		{
			if(in_array($this->action, array('view', 'add')))
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
		$this->Bill->recursive = 0;
		$this->set('bills', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bill->exists($id)) {
			throw new NotFoundException(__('Invalid bill'));
		}
		$options = array('conditions' => array('Bill.' . $this->Bill->primaryKey => $id));
		$this->set('bill', $this->Bill->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		$this->loadModel('Sale', 'RequestHandler');
		$this->loadModel('Product', 'RequestHandler');
        
        $orden_item = $this->Sale->find('all', array('order' => 'Sale.id ASC'));
        
        // debug($orden_item);
        
        if(count($orden_item) > 0)
        {
            $total_pedidos = $this->Sale->find('all', array('fields' => array('SUM(Sale.subtotal) as subtotal')));
            $mostrar_total_pedidos = $total_pedidos[0][0]['subtotal'];
            
            // Recuperando usuarios vendedores
            $users = $this->Bill->User->find('list');
            
            $this->set(compact('orden_item', 'mostrar_total_pedidos', 'users'));
        }
        else
        {
            $this->Flash->error('Ninguna orden ha sido procesada');
            return $this->redirect(array('controller' => 'products', 'action' => 'index'));
        }
        
        if($this->request->is('post'))
        {
        //	$options = array('conditions' => array('Product.id' => $product_id));
        	$options2  = array(
			   /* 'joins' => array(
			        array(
			            'table' => 'products',
			            'alias' => 'Product',
			            'type' => 'LEFT',
			            'conditions' => array(
			                'Sale.product_id = Product.id'
			            )
			        )
			  //  ),*/
			    'conditions' => array(
			        'Product.stock < Sale.quantity',
			    )
			);
			$productosSinStock = $this->Sale->find('all', $options2);
			if(count($productosSinStock) == 0){
				$this->Bill->create();
	            $this->request->data['Bill']['user_id'] = $this->Auth->user('id');
	            if($this->Bill->save($this->request->data))
	            {
	                $id_orden = $this->Bill->id;
	                
	                for($i = 0; $i < count($orden_item); $i++)
	                {
	                    $product_id = $orden_item[$i]['Sale']['product_id'];
	                    $cantidad = $orden_item[$i]['Sale']['quantity'];
	                    $subtotal = $orden_item[$i]['Sale']['subtotal'];
	                    
	                    $orden_items = array('product_id' => $product_id, 'bill_id' => $id_orden, 'quantity' => $cantidad, 'subtotal' => $subtotal);
	                    $this->Bill->BillItem->saveAll($orden_items);
	                    
	                    $options = array('conditions' => array('Product.id' => $product_id));
						$producto = $this->Product->find('first', $options);
						$nuevoStock = $producto['Product']['stock'] - $cantidad;
	                    $this->Product->id = $product_id;
	                    $this->Product->saveField('stock', $nuevoStock);
	                }
	                
	                //Eliminando el contenido de la tabla pedidos
	                $this->Sale->deleteAll(1, false);
	                
	                $this->Flash->success('La orden fue procesada con éxito');
	                return $this->redirect(array('controller' => 'products', 'action' => 'index'));
	            }
	            else
	            {
	                $this->Flash->error('La orden no pudo ser procesada.');
	            } 
			}else{
				$this->Flash->error('Existen items sin stock suficiente para procesar la venta, por favor revísela.');
			}
			
            
        }
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bill->exists($id)) {
			throw new NotFoundException(__('Invalid bill'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bill->save($this->request->data)) {
				$this->Flash->success(__('The bill has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The bill could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bill.' . $this->Bill->primaryKey => $id));
			$this->request->data = $this->Bill->find('first', $options);
		}
		$sellers = $this->Bill->Seller->find('list');
		$this->set(compact('sellers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Bill->id = $id;
		if (!$this->Bill->exists()) {
			throw new NotFoundException(__('Invalid bill'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Bill->delete()) {
			$this->Flash->success(__('The bill has been deleted.'));
		} else {
			$this->Flash->error(__('The bill could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function ventasporvendedor()
    {
    	if ($this->request->is('post')) {
    		$start_year = $this->request->data['Bill']['start']['year'];
    		$start_month = $this->request->data['Bill']['start']['month'];
    		$start_day = $this->request->data['Bill']['start']['day'];
    		$fechainicialString = $start_year . "-" . $start_month . "-" . $start_day . " 00:01";
	    	$start_date = date ( 'Y-m-j' , strtotime($fechainicialString));
	    	$end_year = $this->request->data['Bill']['end']['year'];
    		$end_month = $this->request->data['Bill']['end']['month'];
    		$end_day = $this->request->data['Bill']['end']['day'];
    		$fechafinalString = $end_year . "-" . $end_month . "-" . $end_day . " 23:59";
	    	$end_date = date ( 'Y-m-j' , strtotime($fechafinalString));
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	//$corte = $this->request->data['Bill']['corte'];
    	}else{
    		$start_date = date('Y-m-01');
	    	$end_date = date('Y-m-31');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	//$corte = 10;
    	}
			$options  = array(
			    
			    'conditions' => array(
			        'Bill.created >= ' => $start_date,
	      			'Bill.created <= ' => $end_date2
			    ),
			    'fields' => array(
			    	'User.id', 'User.fullname', 'SUM(Bill.total) as Venta'	
			    ),
			    'group' => 'User.id',
			    'order' => 'Venta DESC'
			);

			$this->set('vendedores', $this->Bill->find('all', $options));
			$this->set('fechainicio', $start_date);
			$this->set('fechatermino', $end_date);
			//$this->set('corte', $corte);
    }
    
    public function exportreport4()
	{
	    if ($this->request->is('get')) {
		    $start_date = $this->params['url']['start'];
		    $end_date = $this->params['url']['end'];
		    $end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    }else{
	    	$start_date = date('Y-m-01'); 
	    	$end_date = date('Y-m-31');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    }
    	$options  = array(
		    'conditions' => array(
		        'Bill.created >= ' => $start_date,
      			'Bill.created <= ' => $end_date2
		    ),
		    'fields' => array(
		    	'User.id', 'User.fullname', 'SUM(Bill.total) as Venta'	
		    ),
		    'group' => 'User.id',
		    'order' => 'Venta DESC'
		);
		$this->set('vendedores', $this->Bill->find('all', $options));
		$this->layout = null;
	    $this->autoLayout = false;
	    Configure::write('debug','0');
	}
	
	public function ventasmensuales()
    {
    	if ($this->request->is('post')) {
    		$start_year = $this->request->data['Bill']['start']['year'];
    		$start_month = $this->request->data['Bill']['start']['month'];
    		$start_day = $this->request->data['Bill']['start']['day'];
    		$fechainicialString = $start_year . "-" . $start_month . "-" . $start_day . " 00:01";
	    	$start_date = date ( 'Y-m-j' , strtotime($fechainicialString));
	    	$end_year = $this->request->data['Bill']['end']['year'];
    		$end_month = $this->request->data['Bill']['end']['month'];
    		$end_day = $this->request->data['Bill']['end']['day'];
    		$fechafinalString = $end_year . "-" . $end_month . "-" . $end_day . " 23:59";
	    	$end_date = date ( 'Y-m-j' , strtotime($fechafinalString));
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	//$corte = $this->request->data['Bill']['corte'];
    	}else{
    		$start_date = date('Y-m-01');
	    	$end_date = date('Y-m-31');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	//$corte = 10;
    	}
			$options  = array(
			    
			    'conditions' => array(
			        'Bill.created >= ' => $start_date,
	      			'Bill.created <= ' => $end_date2
			    ),
			    'fields' => array(
			    	'Bill.payment_method', 'SUM(Bill.total) as Venta', 'COUNT(Bill.total) as Cant_Ventas'	
			    ),
			    'group' => 'Bill.payment_method',
			    'order' => 'Bill.payment_method ASC'
			);

			$this->set('ventas', $this->Bill->find('all', $options));
			$this->set('fechainicio', $start_date);
			$this->set('fechatermino', $end_date);
			//$this->set('corte', $corte);
    }
    
    public function exportreport5()
	{
	    if ($this->request->is('get')) {
		    $start_date = $this->params['url']['start'];
		    $end_date = $this->params['url']['end'];
		    $end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    }else{
	    	$start_date = date('Y-m-01'); 
	    	$end_date = date('Y-m-31');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    }
    	$options  = array(
		    'conditions' => array(
		        'Bill.created >= ' => $start_date,
      			'Bill.created <= ' => $end_date2
		    ),
		    'fields' => array(
		    	'Bill.payment_method', 'SUM(Bill.total) as Venta', 'COUNT(Bill.total) as Cant_Ventas'	
		    ),
		    'group' => 'Bill.payment_method',
		    'order' => 'Bill.payment_method ASC'
		);
		$this->set('ventas', $this->Bill->find('all', $options));
		$this->layout = null;
	    $this->autoLayout = false;
	    Configure::write('debug','0');
	}
	
}
