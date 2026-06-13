<?php
$id_grado_get = $_GET['id_grado'];
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/estudiantes/listado_de_estudiantes.php');

$curso = "";
$paralelo = "";
foreach ($estudiantes as $estudiante) {
    if ($id_grado_get == $estudiante['id_grado']) {
        $curso = $estudiante['curso'];
        $paralelo = $estudiante['paralelo'];
        break;
    }
}
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2>Listado de estudiantes del grado: <?=$curso;?> Paralelo <?=$paralelo;?></h2>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Estudiantes registrados</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th><center>Nro</center></th>
                                        <th><center>Nombres y apellidos</center></th>
                                        <th><center>Nivel</center></th>
                                        <th><center>Turno</center></th>
                                        <th><center>Grado</center></th>                                   
                                        <th><center>Paralelo</center></th>                                   
                                        <th><center>1er periodo</center></th>                                   
                                        <th><center>2do periodo</center></th>                                   
                                        <th><center>3er periodo</center></th>                                   
                                        <th><center>4to periodo</center></th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_estudiantes = 0;
                                    $id_estudiantes = []; // Array para almacenar los IDs de los estudiantes
                                    foreach ($estudiantes as $estudiante) {
                                        if ($id_grado_get == $estudiante['id_grado']) {
                                            $contador_estudiantes++;
                                            $id_estudiantes[] = $estudiante['id_estudiante']; // Guardamos los IDs ?>
                                            <tr>
                                                <td style="text-align: center"><?=$contador_estudiantes;?></td>
                                                <td><?=$estudiante['nombres'] . " " . $estudiante['apellidos'];?></td>
                                                <td style="text-align: center;"><?=$estudiante['nivel'];?></td>
                                                <td style="text-align: center;"><?=$estudiante['turno'];?></td>
                                                <td style="text-align: center;"><?=$estudiante['curso'];?></td>
                                                <td style="text-align: center;"><?=$estudiante['paralelo'];?></td>
                                                <td><input style="text-align: center;" id="nota1_<?=$estudiante['id_estudiante'];?>" type="number" class="form-control"></td>
                                                <td><input style="text-align: center;" id="nota2_<?=$estudiante['id_estudiante'];?>" type="number" class="form-control"></td>
                                                <td><input style="text-align: center;" id="nota3_<?=$estudiante['id_estudiante'];?>" type="number" class="form-control"></td>
                                                <td><input style="text-align: center;" id="nota4_<?=$estudiante['id_estudiante'];?>" type="number" class="form-control"></td>
                                            </tr>
                                        <?php }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <hr>
                            <button class="btn btn-primary btn-lg" id="btn_guardar">Guardar notas</button>
                            
                            <script>
                                $(document).ready(function() {
                                    $('#btn_guardar').click(function(){
                                        var ids = <?= json_encode($id_estudiantes); ?>; // Pasamos los IDs a JavaScript

                                        ids.forEach(function(id) {
                                            var nota1 = $('#nota1_' + id).val();
                                            var nota2 = $('#nota2_' + id).val();
                                            var nota3 = $('#nota3_' + id).val();
                                            var nota4 = $('#nota4_' + id).val();

                                            //alert(nota1 + " - " + nota2 + " - " + nota3 + " - " + nota4);

                                            var url = "../../app/controllers/calificaciones/create.php";
                                            $.get(url,{nota1:nota1},function (datos){
                                                $('#respuesta').html(datos);
                                            });

                                        });
                                    });
                                });
                            </script>
                            <div id="respuesta"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
</div><!-- /.content-wrapper -->

<?php
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Estudiantes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Estudiantes",
                "infoFiltered": "(Filtrado de _MAX_ total Estudiantes)",
                "lengthMenu": "Mostrar _MENU_ Estudiantes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                }, {
                    extend: 'csv'
                }, {
                    extend: 'excel'
                }, {
                    text: 'Imprimir',
                    extend: 'print'
                }]
            },
            {
                extend: 'colvis',
                text: 'Visor de columnas',
                collectionLayout: 'fixed three-column'
            }]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
