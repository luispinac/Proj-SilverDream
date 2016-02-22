<?php
//echo "<pre>";
//print_r($products);
//echo "</pre>";

$line = array_merge($products[0]['Product'], $products[0][0]);
$this->CSV->addRow(array_keys($line));
 foreach ($products as $product)
 {
   $line= array_merge($product['Product'], $product[0]);
   $this->CSV->addRow($line);
 }
 $filename='ProductosPocoMovimiento' . date("Y-m-d-H-i");
 echo  $this->CSV->render($filename);
?>