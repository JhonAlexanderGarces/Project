<?php
$id_pago = $_GET['id'];
$id_estudiante = $_GET['id_estudiante'];
include('../../app/config.php');
require_once('../../public/TCPDF-main/tcpdf.php');
include('../../app/controllers/configuraciones/institucion/listado_de_instituciones.php');
include('../../app/controllers/estudiantes/datos_del_estudiante.php');

foreach ($instituciones as $institucione) {
    $nombre_institucion = $institucione['nombre_institucion'];
    $direccion = $institucione['direccion'];
    $telefono = $institucione['telefono'];
    $celular = $institucione['celular'];
    $correo = $institucione['correo'];
    $logo = $institucione['logo'];
}

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(216,280), true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jhon Alexander Garces');
$pdf->SetTitle('Contrato de Matrícula Escolar');
$pdf->SetSubject('Documento Oficial');
$pdf->SetKeywords('Contrato, Matrícula, Educación, PDF');

$pdf->SetMargins(10, 3, 10);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setFontSubsetting(true);
$pdf->SetFont('Times', '', 11);
$pdf->AddPage();

// Establecer fondo blanco
$pdf->SetFillColor(255, 255, 255);
$pdf->Rect(0, 0, 216, 280, 'F');

$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'module_width' => 1,
    'module_height' => 1
);

$QR = 'Este contrato es verificado por el sistema de inscripción de la Unidad Educativa '.$nombre_institucion.',
por El/la Señor(a) '.$nombres_apellidos_ppff.' con C.C: Nro '.$ci_ppff.' habil por derecho en '.$fechaHora;
$pdf->write2DBarcode($QR, 'QRCODE,L', 175, 10, 30, 30, $style);

$html = '<table border="0">
<tr>
<td width="150px" style="text-align: center"><img src="../../public/images/configuracion/'.$logo.'" width="80px" alt="" ></td>
<td width="400px"></td>
</tr>
<tr>
<td style="text-align: center">
<b>'.$nombre_institucion.'</b> <br>
<small>'.$direccion.'</small> <br>
<small>'.$telefono.' '.$celular.'</small>
</td>
<td style="text-align: center"><h2><b><u>CONTRATO DE MATRÍCULA ESCOLAR PARA ESTUDIANTES</u></b></h2></td>
</tr>
</table>
<p style="text-align: justify">
<b>CONTRATO DE MATRÍCULA</b><br><br><br>
Entre la INSTITUCIÓN EDUCATIVA '.$nombre_institucion.' y el ACUDIENTE '.$nombres_apellidos_ppff.', identificado con cédula N° '.$ci_ppff.', en representación del ESTUDIANTE '.$nombres.' '.$apellidos.', identificado con tarjeta de identidad N° '.$ci.', se suscribe el presente contrato bajo los siguientes términos:<br><br>
<b>1. OBJETO:</b> La INSTITUCIÓN brindará el servicio educativo al ESTUDIANTE en el grado '.$curso.' durante el año lectivo.<br><br>
<b>2. OBLIGACIONES:</b><br>
- LA INSTITUCIÓN proporcionará educación de calidad y velará por el bienestar del estudiante.<br>
- EL ACUDIENTE se compromete a cumplir con los pagos de matrícula y pensiones.<br>
- EL ESTUDIANTE debe cumplir con el reglamento escolar y asistir regularmente.<br><br>
<b>3. DURACIÓN:</b> Este contrato tendrá vigencia durante el año escolar.<br><br>
<b>4. TERMINACIÓN:</b> Podrá finalizar por mutuo acuerdo, incumplimiento o retiro del estudiante.<br><br>
<br><br>
REPRESENTANTE DE LA INSTITUCIÓN<br>
Lic. Jhon Alexander Garces Candamil  <br>
Firma: _______________________<br><br>
<b>'.$nombres_apellidos_ppff.'</b><br>
Firma: _______________________<br><br>
<b>'.$nombres.' '.$apellidos.'</b><br>
Firma: _______________________<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
Firmado en Boston, Massachussets, a los '.$dia_actual.' días del mes '.$mes_actual.' de '.$ano_actual.'. 
</p>';

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output('contrato_matricula.pdf', 'I');
?>