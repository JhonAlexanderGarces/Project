<?php

include ('../../../app/config.php');

session_start();

// Verificar si se recibió el ID por POST
$id_asignacion = $_POST['id_asignacion'] ?? null;

if ($id_asignacion === null) {
    $_SESSION['mensaje'] = "Error: No se recibió un ID de asignación válido.";
    $_SESSION['icono'] = "error";
    header('Location:'.APP_URL."/admin/docentes/asignacion.php");
    exit;
}

// Preparar y ejecutar la eliminación
$sentencia = $pdo->prepare("DELETE FROM asignaciones WHERE id_asignacion = :id_asignacion");
$sentencia->bindParam(':id_asignacion', $id_asignacion, PDO::PARAM_INT);

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "Se eliminó la asignación correctamente en la base de datos.";
    $_SESSION['icono'] = "success";
} else {
    $_SESSION['mensaje'] = "Error: No se pudo eliminar la asignación, comuníquese con el administrador.";
    $_SESSION['icono'] = "error";
}

header('Location:'.APP_URL."/admin/docentes/asignacion.php");
exit;

?>
