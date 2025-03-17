<?php

$sql_pagos = "SELECT * FROM pagos WHERE estudiante_id = :id_estudiante";
$query_pagos = $pdo->prepare($sql_pagos);
$query_pagos->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
$query_pagos->execute();
$pagos = $query_pagos->fetchAll(PDO::FETCH_ASSOC);
