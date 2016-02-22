<?php
App::uses('AppController', 'Controller');
//Configure::write('debug', 0); // ****** DESCOMENTAR!!!!
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

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
	public function index() {
		//$usuario = $this->Session->read('Auth.User.username');
		$usuario = $this->Auth->user('fullname');
		$this->Product->recursive = 0;
		$this->Paginator->settings = array('limit' => 12);
		$this->set('products', $this->Paginator->paginate());
		$this->set('usuario', $usuario);
	}
	
	public function index2() {
		$this->Product->recursive = 0;
		$this->Paginator->settings = array('limit' => 12);
		$this->set('products', $this->Paginator->paginate());
	}
	
	public function searchjson()
	{
		$term = null;
		if(!empty($this->request->query['term']))
		{
			$term = $this->request->query['term'];
			$terms = explode(' ', trim($term));
			$terms = array_diff($terms, array(''));
			foreach($terms as $term)
			{
				$conditions[] = array('Product.code LIKE' => '%' . $term . '%');
			}
			
			$products = $this->Product->find('all', array('recursive' => -1, 'fields' => array('Product.id', 'Product.code', 'Product.photo', 'Product.photo_dir'), 'conditions' => $conditions, 'limit' => 20));
		}
		echo json_encode($products);
		$this->autoRender = false;
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Producto inválido'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}
	

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('El producto ha sido registrado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El producto no pudo ser registrado.'));
			}
		}
		$categories = $this->Product->Category->find('list');
		$this->set(compact('categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Producto inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('El producto ha sido registrado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El producto no pudo ser registrado.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$categories = $this->Product->Category->find('list');
		$this->set(compact('categories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Producto inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Flash->success(__('El producto ha sido eliminado.'));
		} else {
			$this->Flash->error(__('El producto no pudo ser eliminado.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function search()
	{
		$search = null;
		if(!empty($this->request->query['search']))
		{
			$search = $this->request->query['search'];
			$search = preg_replace('/[^a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]/', '', $search);
			$terms = explode(' ', trim($search));
			$terms = array_diff($terms, array(''));
			
			foreach($terms as $term)
			{
				$terms1[] = preg_replace('/[^a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]/', '', $term);
				$conditions[] = array('Product.code LIKE' => '%' . $term . '%');
			}
			$products = $this->Product->find('all', array('recursive' => -1, 'conditions' => $conditions, 'limit' => 200));
			if(count($products) == 1)
			{
				return $this->redirect(array('controller' => 'products', 'action' => 'view', $products[0]['Product']['id']));
			}
			$terms1 = array_diff($terms1, array(''));
			$this->set(compact('products', 'terms1'));
		}
		$this->set(compact('search'));
		
		if($this->request->is('ajax'))
		{
			$this->layout = false;
			$this->set('ajax', 1);
		}
		else
		{
			$this->set('ajax', 0);
		}
	}
	
	public function isAuthorized($user)
	{
		if($user['role'] == 'seller')
		{
			if(in_array($this->action, array('index', 'index2', 'view', 'searchjson', 'search')))
			{
				return true;
			}
			else
			{
				if($this->Auth->user('id'))
				{
					$this->Flash->error('No puede acceder', array('class' => 'alert alert-danger'));
					$this->redirect($this->Auth->redirect());
				}
			}
		}
		
		return parent::isAuthorized($user);
	}
	
	public function exportreport1()
	{
	    if ($this->request->is('get')) {
		    $start_date = $this->params['url']['start'];
		    $end_date = $this->params['url']['end'];
		    $corte = $this->params['url']['corte'];
	    }else{
	    	$start_date = date('Y-m-01'); 
	    	$end_date = date('Y-m-31');
	    	$corte = 15;
	    }
	    $this->Paginator->settings  = array(
		    'joins' => array(
			        array(
			            'table' => 'bill_items',
			            'alias' => 'BillItem',
			            'type' => 'LEFT',
			            'conditions' => array(
			                'BillItem.product_id = Product.id'
			            )
			        )
			    ),
			    'conditions' => array(
			        //'Product.product_type' => 'recurrente',
			       // 'BillItem.quantity' => 1,
			        'BillItem.created >= ' => $start_date,
	      			'BillItem.created <= ' => $end_date
			    ),
			    'fields' => array(
			    	'Product.id', 'Product.description', 'SUM(BillItem.quantity) as Cantidad'	
			    ),
			    'group' => 'Product.id',
			    'order' => 'Cantidad ASC',
			    'limit' => $corte
		);
		$this->set('products', $this->Paginator->paginate());
		$this->layout = null;
	    $this->autoLayout = false;
	    Configure::write('debug','0');
	}
	
	
		
	public function prodpocomovimiento()
    {
    	if ($this->request->is('post')) {
    		$start_year = $this->request->data['Product']['start']['year'];
    		$start_month = $this->request->data['Product']['start']['month'];
    		$start_day = $this->request->data['Product']['start']['day'];
    		$fechainicialString = $start_year . "-" . $start_month . "-" . $start_day . " 00:03";
	    	$start_date = date ( 'Y-m-j' , strtotime($fechainicialString));
	    	$end_year = $this->request->data['Product']['end']['year'];
    		$end_month = $this->request->data['Product']['end']['month'];
    		$end_day = $this->request->data['Product']['end']['day'];
    		$fechafinalString = $end_year . "-" . $end_month . "-" . $end_day . " 00:03";
	    	$end_date = date ( 'Y-m-j' , strtotime($fechafinalString));
	    	$corte = $this->request->data['Product']['corte'];
    	}else{
    		$start_date = date('Y-m-01');
	    	$end_date = date('Y-m-31');
	    	$corte = 15;
    	}
			$this->Paginator->settings  = array(
			    'joins' => array(
			        array(
			            'table' => 'bill_items',
			            'alias' => 'BillItem',
			            'type' => 'LEFT',
			            'conditions' => array(
			                'BillItem.product_id = Product.id'
			            )
			        )
			    ),
			    'conditions' => array(
			        //'Product.product_type' => 'recurrente',
			       // 'BillItem.quantity' => 1,
			        'BillItem.created >= ' => $start_date,
	      			'BillItem.created <= ' => $end_date
			    ),
			    'fields' => array(
			    	'Product.id', 'Product.description', 'SUM(BillItem.quantity) as Cantidad'	
			    ),
			    'group' => 'Product.id',
			    'order' => 'Cantidad ASC',
			    'limit' => $corte
			);
			$this->set('listaProductos', $this->Paginator->paginate());
			$this->set('fechainicio', $start_date);
			$this->set('fechatermino', $end_date);
			$this->set('corte', $corte);
    }
    
    public function prodstockcritico()
    {
    	if ($this->request->is('post')) {
	    	$diferencia = $this->request->data['Product']['diferencia_stock'];
    	}else{
	    	$diferencia = 5;
    	}
			$this->Paginator->settings  = array(
			    'conditions' => array(
			        'Product.product_type' => 'recurrente',
			        'Product.stock - Product.critical_stock < ' . ($diferencia + 1)
			    ),
			    'fields' => array(
			    	'Product.id', 'Product.code', 'Product.description', 'Product.stock', 'Product.critical_stock'	
			    ),
			    'order' => 'Product.stock ASC'
			);
			$this->set('listaProductos', $this->Paginator->paginate());
			$this->set('diferencia', $diferencia);
    }
    
    public function exportreport2()
	{
	    if ($this->request->is('get')) {
		    $diferencia = $this->params['url']['diferencia'];
	    }else{
	    	$diferencia = 5; 
	    }
	    $this->Paginator->settings  = array(
		    'conditions' => array(
		        'Product.product_type' => 'recurrente',
		        'Product.stock - Product.critical_stock < ' . ($diferencia + 1)
		    ),
		    'fields' => array(
		    	'Product.id', 'Product.code', 'Product.description', 'Product.stock', 'Product.critical_stock'	
		    ),
		    'order' => 'Product.stock ASC'
		);
		$this->set('products', $this->Paginator->paginate());
		$this->layout = null;
	    $this->autoLayout = false;
	    Configure::write('debug','0');
	}
	
	public function prodmasvendidos()
    {
    	if ($this->request->is('post')) {
    		$start_year = $this->request->data['Product']['start']['year'];
    		$start_month = $this->request->data['Product']['start']['month'];
    		$start_day = $this->request->data['Product']['start']['day'];
    		$fechainicialString = $start_year . "-" . $start_month . "-" . $start_day . " 00:01";
	    	$start_date = date ( 'Y-m-j' , strtotime($fechainicialString));
	    	$end_year = $this->request->data['Product']['end']['year'];
    		$end_month = $this->request->data['Product']['end']['month'];
    		$end_day = $this->request->data['Product']['end']['day'];
    		$fechafinalString = $end_year . "-" . $end_month . "-" . $end_day . " 23:59";
	    	$end_date = date ( 'Y-m-j' , strtotime($fechafinalString));
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	$corte = $this->request->data['Product']['corte'];
    	}else{
    		$start_date = date('Y-m-01');
	    	$end_date = date('Y-m-31');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	$corte = 10;
    	}
			$options  = array(
			    'joins' => array(
			        array(
			            'table' => 'bill_items',
			            'alias' => 'BillItem',
			            'type' => 'LEFT',
			            'conditions' => array(
			                'BillItem.product_id = Product.id'
			            )
			        )
			    ),
			    'conditions' => array(
			        'BillItem.created >= ' => $start_date,
	      			'BillItem.created <= ' => $end_date2
			    ),
			    'fields' => array(
			    	'Product.id', 'Product.description', 'Product.code', 'SUM(BillItem.quantity) as Suma'	
			    ),
			    'group' => 'Product.id',
			    'order' => 'Suma DESC',
			    'limit' => $corte
			);

			$this->set('listaProductos', $this->Product->find('all', $options));
			$this->set('fechainicio', $start_date);
			$this->set('fechatermino', $end_date);
			$this->set('corte', $corte);
    }
    
    public function exportreport3()
	{
	    if ($this->request->is('get')) {
		    $start_date = $this->params['url']['start'];
		    $end_date = $this->params['url']['end'];
		    $end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
		    $corte = $this->params['url']['corte'];
	    }else{
	    	$start_date = date('Y-m-01'); 
	    	$end_date = date('Y-m-31');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	$corte = 10;
	    }
    	$options  = array(
		    'joins' => array(
		        array(
		            'table' => 'bill_items',
		            'alias' => 'BillItem',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'BillItem.product_id = Product.id'
		            )
		        )
		    ),
		    'conditions' => array(
		        'BillItem.created >= ' => $start_date,
      			'BillItem.created <= ' => $end_date2
		    ),
		    'fields' => array(
		    	'Product.id', 'Product.description', 'Product.code', 'SUM(BillItem.quantity) as Suma'	
		    ),
		    'group' => 'Product.id',
		    'order' => 'Suma DESC',
		    'limit' => $corte
		);
		$this->set('products', $this->Product->find('all', $options));
		$this->layout = null;
	    $this->autoLayout = false;
	    Configure::write('debug','0');
	}
	
	
	public function ventasporproducto()
    {
    	if ($this->request->is('post')) {
    		$start_year = $this->request->data['Product']['start']['year'];
    		$start_month = $this->request->data['Product']['start']['month'];
    		$start_day = $this->request->data['Product']['start']['day'];
    		$fechainicialString = $start_year . "-" . $start_month . "-" . $start_day . " 00:01";
	    	$start_date = date ( 'Y-m-j' , strtotime($fechainicialString));
	    	$end_year = $this->request->data['Product']['end']['year'];
    		$end_month = $this->request->data['Product']['end']['month'];
    		$end_day = $this->request->data['Product']['end']['day'];
    		$fechafinalString = $end_year . "-" . $end_month . "-" . $end_day . " 23:59";
	    	$end_date = date ( 'Y-m-j' , strtotime($fechafinalString));
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    //	$corte = $this->request->data['Product']['corte'];
    	}else{
    		$start_date = date('Y-m-01');
	    	$end_date = date('Y-m-31');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	//$corte = 10;
    	}
			$this->Paginator->settings  = array(
			    'joins' => array(
			        array(
			            'table' => 'bill_items',
			            'alias' => 'BillItem',
			            'type' => 'LEFT',
			            'conditions' => array(
			                'BillItem.product_id = Product.id'
			            )
			        ),
			        array(
			            'table' => 'bills',
			            'alias' => 'Bill',
			            'type' => 'LEFT',
			            'conditions' => array(
			                'Bill.id = BillItem.bill_id'
			            )
			        )
			    ),
			    'conditions' => array(
			        'BillItem.created >= ' => $start_date,
	      			'BillItem.created <= ' => $end_date2
			    ),
			    'fields' => array(
			    	'Product.id', 'Product.description', 'Product.code', 'BillItem.quantity', 'BillItem.created', 'Bill.bill_number', 'Bill.id'	
			    ),
			    'order' => 'Product.id ASC'
			    //'limit' => $corte
			);

			$this->set('listaProductos', $this->Paginator->paginate());
			$this->set('fechainicio', $start_date);
			$this->set('fechatermino', $end_date);
			//$this->set('corte', $corte);
    }
    
    public function exportreport6()
	{
		$this->Product->recursive = 0;
	    if ($this->request->is('get')) {
		    $start_date = $this->params['url']['start'];
		    $end_date = $this->params['url']['end'];
		    $end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
		    //$corte = $this->params['url']['corte'];
	    }else{
	    	$start_date = date('Y-m-01'); 
	    	$end_date = date('Y-m-31');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    	//$corte = 10;
	    }
    	$options  = array(
		    'joins' => array(
		        array(
		            'table' => 'bill_items',
		            'alias' => 'BillItem',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'BillItem.product_id = Product.id'
		            )
		        ),
		        array(
		            'table' => 'bills',
		            'alias' => 'Bill',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'Bill.id = BillItem.bill_id'
		            )
		        )
		    ),
		    'conditions' => array(
		        'BillItem.created >= ' => $start_date,
      			'BillItem.created <= ' => $end_date2
		    ),
		    'fields' => array(
		    	'Product.id', 'Product.code', 'Product.description', 'BillItem.quantity', 'BillItem.created', 'Bill.bill_number', 'Bill.id'	
		    ),
		    'order' => 'Product.id ASC'
		);
		$this->set('products', $this->Product->find('all', $options));
		$this->layout = null;
	    $this->autoLayout = false;
	    Configure::write('debug','0');
	}
	
	public function addstock() {
		
		if ($this->request->is('post')) {
			$options = array('conditions' => array('Product.code' => $this->request->data['Product']['code']));
			$producto = $this->Product->find('first', $options);
			if($producto){
				$nuevoStock = $this->request->data['Product']['stock'] + $producto['Product']['stock'];
				$this->Product->id = $producto['Product']['id'];
				if ($this->Product->saveField('stock', $nuevoStock)) {
					$this->Flash->success(__('El stock para el producto ' . $producto['Product']['code'] . ' ha sido modificado.'));
					//return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('El stock no pudo ser modificado.'));
				}
			}else{
				$this->Flash->error(__('No existe un producto con ese código.'));
			}
		} else {
			//nada
		}
	}

}
