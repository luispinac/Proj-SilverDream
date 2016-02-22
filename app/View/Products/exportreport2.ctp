<?php
    //$line = $products[0]['Product'];
    $line = array('id', 'Código', 'Descripción', 'Stock', 'Stock crítico');
    $this->CSV->addRow($line);
     foreach ($products as $product)
     {
       $line= $product['Product'];
       $this->CSV->addRow($line);
     }
     $filename='ProductosPocoMovimiento' . date("Y-m-d-H-i");
     echo  $this->CSV->render($filename);
?>