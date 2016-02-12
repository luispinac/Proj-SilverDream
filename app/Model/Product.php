<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Category $Category
 * @property Sale $Sale
 */
class Product extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $actsAs = array(
			'Upload.Upload' => array(
				'photo' => array(
					'fields' => array(
						'dir' => 'photo_dir'
					),
					'thumbnailMethod' => 'php',
					'thumbnailSizes' => array(
						'vga' => '640x480',
						'thumb' => '150x150'
					),
					'deleteOnUpdate' => true,
					'deleteFolderOnDelete' => true
			)
		)
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo no debe estar vacío',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sólo ingrese números',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El campo no puede estar vacío',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'stock' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sólo ingrese números',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El campo no puede estar vacío',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'critical_stock' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sólo ingrese números',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'product_type' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El campo no puede estar vacío',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'photo' => array(
        	'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Algo anda mal, intente nuevamente',
				'on' => 'create'
			),
	    	'isUnderPhpSizeLimit' => array(
	    		'rule' => 'isUnderPhpSizeLimit',
	        	'message' => 'Archivo excede el límite de tamaño de archivo de subida'
	        ),
		    'isValidMimeType' => array(
	    		'rule' => array('isValidMimeType', array('image/jpeg', 'image/png'), false),
        		'message' => 'La imagen no es jpg ni png',
	    	),
		    'isBelowMaxSize' => array(
	    		'rule' => array('isBelowMaxSize', 1048576),
        		'message' => 'El tamaño de imagen es demasiado grande'
	    	),
		    'isValidExtension' => array(
	    		'rule' => array('isValidExtension', array('jpg', 'png'), false),
        		'message' => 'La imagen no tiene la extension jpg o png'
	    	),
		    'checkUniqueName' => array(
                'rule' => array('checkUniqueName'),
                'message' => 'La imagen ya se encuentra registrada',
                'on' => 'update'
        	),		
			),
		'category_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'El campo no puede estar vacío',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Sale' => array(
			'className' => 'Sale',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function checkUniqueName($data)
	{
	    $isUnique = $this->find('first', array('fields' => array('Product.photo'), 'conditions' => array('Product.photo' => $data['photo'])));

	    if(!empty($isUnique))
	    {
	        return false;
	    }
	    else
	    {
	        return true;
	    }
	}

}
