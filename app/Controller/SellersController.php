<?php
App::uses('AppController', 'Controller');
/**
 * Sellers Controller
 *
 * @property Seller $Seller
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class SellersController extends AppController {

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
	public function index() {
		$this->Seller->recursive = 0;
		$this->set('sellers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Seller->exists($id)) {
			throw new NotFoundException(__('Invalid seller'));
		}
		$options = array('conditions' => array('Seller.' . $this->Seller->primaryKey => $id));
		$this->set('seller', $this->Seller->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Seller->create();
			if ($this->Seller->save($this->request->data)) {
				$this->Flash->success(__('The seller has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The seller could not be saved. Please, try again.'));
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
		if (!$this->Seller->exists($id)) {
			throw new NotFoundException(__('Invalid seller'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Seller->save($this->request->data)) {
				$this->Flash->success(__('The seller has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The seller could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Seller.' . $this->Seller->primaryKey => $id));
			$this->request->data = $this->Seller->find('first', $options);
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
		$this->Seller->id = $id;
		if (!$this->Seller->exists()) {
			throw new NotFoundException(__('Invalid seller'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Seller->delete()) {
			$this->Flash->success(__('The seller has been deleted.'));
		} else {
			$this->Flash->error(__('The seller could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
