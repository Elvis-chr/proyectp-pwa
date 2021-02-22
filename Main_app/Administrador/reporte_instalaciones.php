<?php
    session_start();                    

    if(isset($_SESSION['usuario'])){

        if($_SESSION['usuario']['rol_id'] != "1"){
            header("Location: ../Operador/indexo.php") && 
            header("Location: ../Estandar/indexe.php");
        }        
    }else{
        header('Location: ../../index.php');
    }

	include ('../conexion.php');
	require 'Classes/PHPExcel.php';

    $fecha1 = $_POST['fecha1'];
    $fecha2 = $_POST['fecha2'];


    if (isset($_POST['generar_reporte'])) {
        


        $sql ="SELECT u.id_usuario, u.Nombre, u.Apellido, u.Usuario,i.id_instalacion, i.latitude, 
        i.longitude, i.fecha, i.parroquia, i.direccion, i.tipo_componente, i.usuario_id, d.tipo,t.rol
                                        FROM usuarios u
                                        INNER JOIN instalaciones i ON i.usuario_id = u.id_usuario
                                        INNER JOIN dispositivos d ON i.tipo_componente = d.id_componente
                                        INNER JOIN tipo_usuario t ON u.rol_id = t.id 
										WHERE fecha BETWEEN '$fecha1' and '$fecha2' ORDER BY id_instalacion ";
										
		$resultado = $mysqli->query($sql);
		$fila = 7;

			
		$gdImage = imagecreatefrompng('reportes/logo-izquierdo.png');//Logotipo
	
		//Objeto de PHPExcel
		$objPHPExcel  = new PHPExcel();
		
		//Propiedades de Documento
		$objPHPExcel->getProperties()->setCreator("Seguridad Ciudadana")->setDescription("Reporte de Instalaciones");
		
		//Establecemos la pestaña activa y nombre a la pestaña
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle("instalaciones");
		
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setName('Logotipo');
		$objDrawing->setDescription('Logotipo');
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setHeight(100);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		
		$estiloTituloReporte = array(
		'font' => array(
		'name'      => 'Arial',
		'bold'      => true,
		'italic'    => false,
		'strike'    => false,
		'size' =>13
		),
		'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_NONE
		)
		),
		'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		);
		
		$estiloTituloColumnas = array(
		'font' => array(
		'name'  => 'Arial',
		'bold'  => true,
		'size' =>10,
		'color' => array(
		'rgb' => 'FFFFFF'
		)
		),
		'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '538DD5')
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
		),
		'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		);
		
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray( array(
		'font' => array(
		'name'  => 'Arial',
		'color' => array(
		'rgb' => '000000'
		)
		),
		'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
		),
		'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		));
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:I4')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($estiloTituloColumnas);
		
		$objPHPExcel->getActiveSheet()->setCellValue('B3', 'REPORTE DE INSTALACIONES');
		$objPHPExcel->getActiveSheet()->mergeCells('B3:H3');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'ID Instalacion');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->setCellValue('B6', 'RESPONSABLE');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->setCellValue('C6', 'USUARIO');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('D6', 'LATITUD');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('E6', 'LONGITUD');
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('F6', 'FECHA');
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->setCellValue('G6', 'PARROQUIA');
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->setCellValue('H6', 'DIRECCION');
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('I6', 'COMPONENTE');
	
	//Recorremos los resultados de la consulta y los imprimimos
	while($rows = $resultado->fetch_assoc()){
		
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['id_instalacion']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['Nombre']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['Usuario']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['latitude']);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['longitude']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['fecha']);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $rows['parroquia']);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $rows['direccion']);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $rows['tipo']);

		$fila++;

	}
	
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Instalaciones.csv"');
	header('Cache-Control: max-age=0');

	$writer = new PHPExcel_Writer_Excel2007($objPHPExcel);
	
	$writer->save('php://output');

    }

?>