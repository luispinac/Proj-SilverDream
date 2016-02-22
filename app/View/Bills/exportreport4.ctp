
<?php
//echo "<pre>";
//print_r($vendedores);
//echo "</pre>";
   $line = array('id', 'Nombre_Vendedor', 'Venta');
    $this->CSV->addRow($line);
     foreach ($vendedores as $vendedor)
     {
       $line= array_merge($vendedor['User'], $vendedor[0]);
       $this->CSV->addRow($line);
     }
     $filename='VentasPorVendedor' . date("Y-m-d-H-i");
     echo  $this->CSV->render($filename);
?>