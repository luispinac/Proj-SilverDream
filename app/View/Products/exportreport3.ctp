
<?php
//echo "<pre>";
//print_r($products);
//echo "</pre>";
    //$line = $products[0]['Product'];
    $line = array( 'id', 'Código', 'Descripción', 'Venta');
    $this->CSV->addRow($line);
     foreach ($products as $product)
     {
       $line= array_merge($product['Product'], $product[0]);
       $this->CSV->addRow($line);
     }
     $filename='ProductosMasVendidos' . date("Y-m-d-H-i");
     echo  $this->CSV->render($filename);
?>