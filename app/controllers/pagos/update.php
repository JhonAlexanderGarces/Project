<?php
include ('../../../app/config.php');

$id_pago = $_POST['id_pago'];
$estudiante_id = $_POST['estudiante_id'];
$mes_pagado = $_POST['mes_pagado'];
$monto_pagado = $_POST['monto_pagado'];
$fecha_pagado = $_POST['fecha_pagado'];

$fechaHora = date("Y-m-d H:i:s"); // Captura fecha y hora actual
$estado_de_registro = "activo"; // Estado por defecto

$sentencia = $pdo->prepare('UPDATE pagos 
      SET mes_pagado=:mes_pagado, 
          monto_pagado=:monto_pagado, 
          fecha_pagado=:fecha_pagado, 
          fyh_actualizacion=:fyh_actualizacion 
    WHERE id_pago=:id_pago');

$sentencia->bindParam(':mes_pagado', $mes_pagado);
$sentencia->bindParam(':monto_pagado', $monto_pagado);
$sentencia->bindParam(':fecha_pagado', $fecha_pagado);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_pago', $id_pago);    


if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el pago correctamente en la base de datos";
    $_SESSION['icono'] = "success";
    ?><script>window.history.back();</script><?php
    exit();
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: No se pudo registrar el pago. Comuníquese con el administrador.";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
    exit();
}


