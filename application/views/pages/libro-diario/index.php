<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/main.css">
<title>LIBRO DIARIO</title>
</head>
<body>
    <nav class="navbar navbar-default dark-color-background">
        <div class="container-fluid">
             <div class="navbar-header titulo">
                 <h1>Libro Diario</h1>
             </div>
        </div>
    </nav>
 <div class="container">
     
         <a role="button" class="btn btn-default pull-right btn-accion button-softline" href="../libro-diario/nuevo" >
            <span class="glyphicon glyphicon-plus"></span> Nueva Transaccion
         </a>
          
<table class="table table-bordered table-hover">
<tr class= "primary-color-background">
  <td><strong> Numero </strong></td>
  <td><strong> Fecha </strong></td>
  <td><strong> Detalle </strong></td>
  <td><strong> Debe </strong></td>
  <td><strong> Haber </strong></td>
</tr>
<?php foreach ($detalle as $detail): ?> 
    <tr>
        <td><strong> <?=$detail->idTransaction ?> </strong></td>
        <td> <?=$detail->date ?> </td>
        <td> <?=$detail->account ?> </td>
        <td> <?=$detail->payrate ?> </td>
        <td> <?=$detail->payrate ?> </td>
    </tr>
  <?php endforeach; ?>
 </table>
</div>
</body>
</html>