<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Flash', 'Session', 'RequestHandler');
	public $helpers = array('Html', 'Form', 'Time', 'Js');
	
	public $paginate = array(
        'Category' => array(
        	'limit' => 10,
        	'order' => array('Category.id' => 'asc')
    	),
        'Product' => array(
        	'limit' => 8,
        	'recursive' => 0,
        	'order' => array('Product.id' => 'asc')
        )
    );

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Categoría Inválida'));
		}
		$options = array('conditions' => array('Category.id' => $id));
	//	$this->set('category', $this->Category->find('first', $options));
		
		
	

		$catList = $this->Category->find('first', $options);

		$categoryId = $catList['Category']['id'];

	//	$this->paginate['Product']['limit'] = 4;
		$this->paginate['Product']['conditions'] = array('Product.category_id' => $categoryId);
		$this->paginate['Product']['fields'] = array('Product.id', 'Product.code', 'Product.price', 'Product.photo', 'Product.photo_dir', 'Product.category_id');

		// Categoría Platillo
		$productCat = $catList['Category']['category_name'];

		$this->set('products', $this->paginate('Product'));
		$this->set('nombreCategoria', $productCat);
	//	$this->set('idcat', $productId);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('La categoría ha sido registrada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('La categoría no pudo ser registrada.'));
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
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Categoría inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('La categoría ha sido registrada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('La categoría no pudo ser registrada.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
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
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Categoría inválida'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Category->delete()) {
			$this->Flash->success(__('La categoría ha sido Eliminada.'));
		} else {
			$this->Flash->error(__('La categoría no pudo ser eliminada.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
