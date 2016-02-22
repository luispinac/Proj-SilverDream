<?php
App::uses('AppController', 'Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ClientsController extends AppController {

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
			if(in_array($this->action, array('index', 'view', 'add')))
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
		$this->Client->recursive = 0;
		$this->set('clients', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Cliente inválido'));
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Client->create();
			if ($this->Client->save($this->request->data)) {
				$this->Flash->success(__('El cliente ha sido registrado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El cliente no pudo ser registrado.'));
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
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Cliente inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Client->save($this->request->data)) {
				$this->Flash->success(__('El cliente ha sido registrado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El cliente no pudo ser registrado.'));
			}
		} else {
			$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
			$this->request->data = $this->Client->find('first', $options);
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
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Cliente inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Client->delete()) {
			$this->Flash->success(__('El cliente ha sido eliminado.'));
		} else {
			$this->Flash->error(__('El cliente no pudo ser eliminado.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function clientesfrecuentes()
    {
    	if ($this->request->is('post')) {
    		$start_year = $this->request->data['Client']['start']['year'];
    		$start_month = $this->request->data['Client']['start']['month'];
    		$start_day = $this->request->data['Client']['start']['day'];
    		$fechainicialString = $start_year . "-" . $start_month . "-" . $start_day . " 00:01";
	    	$start_date = date ( 'Y-m-j' , strtotime($fechainicialString));
	    	$end_year = $this->request->data['Client']['end']['year'];
    		$end_month = $this->request->data['Client']['end']['month'];
    		$end_day = $this->request->data['Client']['end']['day'];
    		$fechafinalString = $end_year . "-" . $end_month . "-" . $end_day . " 23:59";
	    	$end_date = date( 'Y-m-j' , strtotime($fechafinalString));
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
    	}else{
    		$start_date = date( 'Y-m-j' , strtotime('2016-01-01-00:01'));
	    	$end_date = date('Y-m-d');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
    	}
			$options  = array(
			    
			    'conditions' => array(
			        'Client.created >= ' => $start_date,
	      			'Client.created <= ' => $end_date2
			    ),
			    'fields' => array(
			    	'Client.id', 'Client.first_name', 'Client.last_name', 'Client.email', 'Client.created'	
			    ),
			    'order' => 'Client.last_name ASC'
			);

			$this->set('clientes', $this->Client->find('all', $options));
			$this->set('fechainicio', $start_date);
			$this->set('fechatermino', $end_date);
    }
    
    public function exportreport7()
	{
	    if ($this->request->is('get')) {
		    $start_date = $this->params['url']['start'];
		    $end_date = $this->params['url']['end'];
		    $end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    }else{
	    	$start_date = date( 'Y-m-j' , strtotime('2016-01-01-00:01'));
	    	$end_date = date('Y-m-d');
	    	$end_date2 = date('Y-m-d', strtotime($end_date. ' + 1 days'));
	    }
    	$options  = array(
			    
			    'conditions' => array(
			        'Client.created >= ' => $start_date,
	      			'Client.created <= ' => $end_date2
			    ),
			    'fields' => array(
			    	'Client.id', 'Client.first_name', 'Client.last_name', 'Client.email', 'Client.created'	
			    ),
			    'order' => 'Client.last_name ASC'
			);
		$this->set('clientes', $this->Client->find('all', $options));
		$this->layout = null;
	    $this->autoLayout = false;
	    Configure::write('debug','0');
	}
}
