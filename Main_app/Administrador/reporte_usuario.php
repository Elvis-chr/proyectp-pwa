<?php

    require('../fpdf/fpdf.php');


    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('reportes/logo-izquierdo.png', 5, 5, 20 );
            $this->SetFont('Arial','B',15);
            $this->Cell(30);
            $this->Cell(120,10, 'Reporte De Usuarios',0,0,'C');
            $this->Ln(20);
        }
        
        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial','I', 8);
            $this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
        }		
    }


        require ('../conexion.php');

        $query = "SELECT u.id_usuario, u.Nombre, u.Apellido, u.Correo, u.Usuario, t
        .rol FROM usuarios u INNER JOIN tipo_usuario t ON u.rol_id = t.id ";
        
        $result = $mysqli->query($query);

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(20,6,'ID',1,0,'C',1);
        $pdf->Cell(30,6,'NOMBRE',1,0,'C',1);
        $pdf->Cell(30,6,'APELLIDO',1,0,'C',1);
        $pdf->Cell(50,6,'CORREO',1,0,'C',1);
        $pdf->Cell(30,6,'USUARIO',1,0,'C',1);
        $pdf->Cell(25,6,'ROL',1,1,'C',1);





        $pdf->SetFont('Arial','',10);

        while($row = $result->fetch_assoc())
        {
            $pdf->Cell(20,6,utf8_decode($row['id_usuario']),1,0,'C');
            $pdf->Cell(30,6,utf8_decode($row['Nombre']),1,0,'C');
            $pdf->Cell(30,6,utf8_decode($row['Apellido']),1,0,'C');
            $pdf->Cell(50,6,utf8_decode($row['Correo']),1,0,'C');
            $pdf->Cell(30,6,utf8_decode($row['Usuario']),1,0,'C');
            $pdf->Cell(25,6,utf8_decode($row['rol']),1,1,'C');


        }
        $pdf->Output();


?>