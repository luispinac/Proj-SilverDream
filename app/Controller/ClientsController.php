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
}
