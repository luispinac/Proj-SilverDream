<?php
//echo "<pre>";
//print_r($products);
//echo "</pre>";
    //$line = $products[0]['Product'];
    $line = array('id', 'Código', 'Descripción', 'Cantidad', 'Fecha venta', 'Número venta');
    $this->CSV->addRow($line);
     foreach ($products as $product)
     {
       $line= array_merge($product['Product'], $product['BillItem'], $product['Bill']);
       $this->CSV->addRow($line);
     }
     $filename='VentasPorProducto' . date("Y-m-d-H-i");
     echo  $this->CSV->render($filename);
?>