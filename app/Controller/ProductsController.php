<?php
App::uses('AppController', 'Controller');
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

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Product->recursive = 0;
		$this->Paginator->settings = array('limit' => 12);
		$this->set('products', $this->Paginator->paginate());
	}
	
	public function index2() {
		$this->Product->recursive = 0;
		$this->Paginator->settings = array('limit' => 12);
		$this->set('products', $this->Paginator->paginate());
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
				$conditions[] = array('Platillo.nombre LIKE' => '%' . $term . '%');
			}
			$platillos = $this->Platillo->find('all', array('recursive' => -1, 'conditions' => $conditions, 'limit' => 200));
			if(count($platillos) == 1)
			{
				return $this->redirect(array('controller' => 'platillos', 'action' => 'view', $platillos[0]['Platillo']['id']));
			}
			$terms1 = array_diff($terms1, array(''));
			$this->set(compact('platillos', 'terms1'));
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
}
