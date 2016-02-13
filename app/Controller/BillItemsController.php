<?php

class BillItemsController extends AppController {
    
    public $components = array('Session', 'RequestHandler');
    public $helpers = array('Html', 'Form', 'Time', 'Js');
    
    public $paginate = array(
            'limit' => 10,
            'order' => array(
                'BillItem.id' => 'asc'
            )
        );

    public function view($id = null)
    {
        $this->BillItem->recursive = 2;
        
        if(!$this->BillItem->Bill->exists($id))
        {
            throw new NotFoundException('boleta invalida');
        }
        
        //$this->paginate['BillItem']['limit'] = 2;
        $this->paginate['BillItem']['conditions'] = array('BillItem.bill_id' => $id);
        //$this->paginate['BillItem']['order'] = array('BillItem.id' => 'asc');
        $this->set('billitems', $this->paginate());
    }
    
}

?>