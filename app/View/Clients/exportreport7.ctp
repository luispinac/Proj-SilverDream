
<?php
//echo "<pre>";
//print_r($products);
//echo "</pre>";
    $line = array( 'Id', 'Nombre', 'Apellido', 'Email', 'Fecha Agregado');
    $this->CSV->addRow($line);
     foreach ($clientes as $cliente)
     {
       $line= $cliente['Client'];
       $this->CSV->addRow($line);
     }
     $filename='ClientesFrecuentes' . date("Y-m-d-H-i");
     echo  $this->CSV->render($filename);
?>