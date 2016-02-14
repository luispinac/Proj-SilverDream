<?php
App::uses('AppController', 'Controller');
//AuthComponent::user('id');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	public $helpers = array('Auth');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}
	
	public function login()
	{
		if($this->request->is('post'))
		{
			if($this->Auth->login())
			{
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error('Usuario y/o contraseña son incorrectos!');
		}
	}
	
	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		//$this->Auth->allow('add');
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//$usuario = $this->Session->read('Auth.User.username');
		$usuario = $this->Auth->user('fullname');
		if ($this->request->is('post')) {
			//$usuario = $this->Auth->user('id');
			//$userdata = $this->session->read('Auth.User');
			
			$this->User->create();
			$this->request->data['User']['enable'] = 1;
			$this->request->data['User']['role'] = $usuario;
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('El usuario ha sido registrado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El usuario no pudo ser registrado.'));
			}
		}
		$this->set('usuario', $usuario);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('El usuario ha sido registrado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El usuario no pudo ser registrado.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('El usuario ha sido eliminado.'));
		} else {
			$this->Flash->error(__('El usuario no pudo ser eliminado.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
