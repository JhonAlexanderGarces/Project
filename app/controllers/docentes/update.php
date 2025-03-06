<?php

include ('../../../app/config.php');
session_start();

$id_usuario = $_POST['id_usuario'];
$id_persona = $_POST['id_persona'];
$id_docente = $_POST['id_docente'];

$rol_id = $_POST['rol_id'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$ci = $_POST['ci'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$celular = $_POST['celular'];
$profesion = $_POST['profesion'];
$direccion = $_POST['direccion'];
$especialidad = $_POST['especialidad'];
$antiguedad = $_POST['antiguedad'];

$fechaHora = date('Y-m-d H:i:s'); // Definir fecha y hora actual

$pdo->beginTransaction();

// ACTUALIZAR A LA TABLA USUARIOS
$password = password_hash($ci, PASSWORD_DEFAULT);

$sentencia = $pdo->prepare('UPDATE usuarios
       SET rol_id=:rol_id,
           email=:email,
           password=:password, 
           fyh_actualizacion=:fyh_actualizacion

WHERE id_usuario=:id_usuario');

$sentencia->bindParam(':rol_id', $rol_id);
$sentencia->bindParam(':email', $email);
$sentencia->bindParam(':password', $password);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->execute();


// ACTUALIZAR LA TABLA PERSONAS
$sentencia = $pdo->prepare('UPDATE personas
       SET nombres=:nombres,
           apellidos=:apellidos,
           ci=:ci,
           fecha_nacimiento=:fecha_nacimiento,
           celular=:celular,
           profesion=:profesion,
           direccion=:direccion, 
           fyh_actualizacion=:fyh_actualizacion

WHERE id_persona=:id_persona');

$sentencia->bindParam(':id_persona', $id_persona);
$sentencia->bindParam(':nombres', $nombres);
$sentencia->bindParam(':apellidos', $apellidos);
$sentencia->bindParam(':ci', $ci);
$sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$sentencia->bindParam(':celular', $celular);
$sentencia->bindParam(':profesion', $profesion);
$sentencia->bindParam(':direccion', $direccion);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);

$sentencia->execute();



// ACTUALIZAR LA TABLA DOCENTES
$sentencia = $pdo->prepare('UPDATE docentes
       SET especialidad=:especialidad,
           antiguedad=:antiguedad,
           fyh_actualizacion=:fyh_actualizacion

WHERE id_docente=:id_docente');

$sentencia->bindParam(':id_docente', $id_docente);
$sentencia->bindParam(':especialidad', $especialidad);
$sentencia->bindParam(':antiguedad', $antiguedad);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);

if ($sentencia->execute()) {
    $pdo->commit();
    $_SESSION['mensaje'] = "Se actualizo los datos del personal docente correctamente.";
    $_SESSION['icono'] = "success";
    header('Location:' . APP_URL . "/admin/docentes");
    exit();
} else {
    $pdo->rollBack();
    $_SESSION['mensaje'] = "Error: no se pudo actualizar en la base de datos. Contacte al administrador.";
    $_SESSION['icono'] = "error";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

?>
