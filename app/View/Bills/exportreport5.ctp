
<?php
//echo "<pre>";
//print_r($ventas);
//echo "</pre>";
   $line = array('id','Método de pago', 'Ventas', 'Cantidad de ventas');
    $this->CSV->addRow($line);
     foreach ($ventas as $venta)
     {
       $line= array_merge($venta['Bill'], $venta[0]);
       $this->CSV->addRow($line);
     }
     $filename='VentasMensualesTotales' . date("Y-m-d-H-i");
     echo  $this->CSV->render($filename);
?>