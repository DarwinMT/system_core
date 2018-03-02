<!DOCTYPE html>
<html>
<head>
	<title></title>


<style type="text/css">
	body{
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 11px;
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            position: absolute;
        }

        .col-xs-3, .col-xs-6,  .col-xs-12 {
            position: relative;
            min-height: 1px;
            padding-right: 5px;
            padding-left: 5px;
        }

        /*.col-xs-3, .col-xs-6, .col-xs-12 {
            float: left;
        }*/

        .col-xs-12 {
            width: 100%;
        }

        .col-xs-6 {
            float: left;
            width: 50%;
        }

        .col-xs-3 {
            float: left;
            width: 25%;
        }

        .form-control {
            /*display: block;*/
            width: 100%;
            height: 20px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;

            

        }

        .table {
            border-collapse: collapse !important;
        }
        .table td,
        .table th {
            background-color: #fff !important;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 5px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .text-right
		{
		    text-align: right !important;
		}

		.text-center
		{
		    text-align: center !important;
		}

		.text-left
		{
		    text-align: left !important;
		}
		.bg-primary{
		    background:#2F70A8 !important;
		}
		.bg-success{
		    background:#DFF0D8 !important;
		}
		.bg-warning{
		    background:#FCF8E3 !important;
		}



</style>	
</head>
<body >

	<div class="row" >

        <table class="table table-bordered table-striped table-condensend">
            <tr>
                <th> Establecimiento</th>
                <th colspan="2">Nombre</th>
                <th>Sexo</th>
                <th>Edad</th>
                <th>Nº Historia Clínica </th>
            </tr>
            <tr>
                <td><?php echo $agenda[0]->usuario->persona->personaempresa[0]->empresa->nombre; ?></td>

                <td colspan="2"><?php echo $agenda[0]->cliente->persona->apellido." ".$agenda[0]->cliente->persona->nombre; ?> </td>
                <td><?php echo $agenda[0]->cliente->persona->genero; ?></td>
                <?php 
	                $fecha = time() - strtotime($agenda[0]->cliente->persona->fechan);
					$edad = floor((($fecha / 3600) / 24) / 360);
                ?>
                <td><?php echo $edad." años "; ?></td>
                <td><?php echo $agenda[0]->cliente->numerohistoria; ?> <?php echo "<script> Edad('aa'); </script>"; ?></td>
            </tr>

            <tr>
                <th colspan="6">1 Motivo De La Consulta</th>
            </tr>

            <tr>
                <td colspan="6">
                    <?php echo $anamnesis[0]->motivo; ?> 
                </td>
            </tr>

            <tr >
                <th colspan="6" >
                	2 Antecedentes Personales
                    <i style="font-size: 9px; float: right;">(Datos Clínicos- Quirurgicos Relevante  Y Gineco Obstétricos)</i>
                </th>
            </tr>

            <tr>
                <td colspan="6">
                    <?php echo $anamnesis[0]->antecedentespersonales; ?> 
                </td>
            </tr>

            <tr>
                <th colspan="6">3 Antecedentes Familiares</th>
            </tr>

            <tr>
                <td colspan="6" >

                	<label style=" font-size: 9px !important; vertical-align: middle;" > 1. Cardiopatía 
                		<input style=" vertical-align: middle;" type="checkbox" name="cardiopatia" id="cardiopatia" <?php  if($anamnesis[0]->antecedentesfamiliares[0]->cardiopatia==1) echo "checked"; ?> > 
                	</label>

                        

                    <label style=" font-size: 9px !important; vertical-align: middle;"  >
                        2. Diabetes <input type="checkbox" style=" vertical-align: middle;"  name="diabetes" id="diabetes" <?php  if($anamnesis[0]->antecedentesfamiliares[0]->diabetes==1) echo "checked"; ?> > 
                    </label>


                   <label style=" font-size: 9px !important; vertical-align: middle;" >
                        3. Enf. Car. Vascular <input type="checkbox" style=" vertical-align: middle;"  name="carvascular" id="carvascular" <?php  if($anamnesis[0]->antecedentesfamiliares[0]->vascular==1) echo "checked"; ?> > 
                   </label>

                    <label style=" font-size: 9px !important; vertical-align: middle;" >
                        4. Hipertensión <input type="checkbox" style=" vertical-align: middle;"  name="cancer" id="cancer" <?php  if($anamnesis[0]->antecedentesfamiliares[0]->hipertencion==1) echo "checked"; ?> > 
                    </label>

                    <label style=" font-size: 9px !important; vertical-align: middle;" >
                        5. Cáncer <input  style=" vertical-align: middle;"  type="checkbox" name="cancer" id="cancer" <?php  if($anamnesis[0]->antecedentesfamiliares[0]->cancer==1) echo "checked"; ?> > 
                    </label>

                    <label style=" font-size: 9px !important; vertical-align: middle;" >
	                    6. Tuberculosis <input  style=" vertical-align: middle;"  type="checkbox" name="tuberculosis" id="tuberculosis"  <?php  if($anamnesis[0]->antecedentesfamiliares[0]->tuberculosis==1) echo "checked"; ?>  > 
	                </label>


                    <label style=" font-size: 9px !important; vertical-align: middle;"  >
                        7. Enf. Mental <input type="checkbox" style=" vertical-align: middle;"  name="mental" id="mental"  <?php  if($anamnesis[0]->antecedentesfamiliares[0]->enfmental==1) echo "checked"; ?>   > 
                    </label>

                    <label style=" font-size: 9px !important; vertical-align: middle;"  >
                        8. Enf. Infecciosa <input type="checkbox" style=" vertical-align: middle;"  name="infecciosa" id="infecciosa"  <?php  if($anamnesis[0]->antecedentesfamiliares[0]->enfinfecciosa==1) echo "checked"; ?> > 
                    </label>


                    <label style=" font-size: 9px !important; vertical-align: middle;"  >
                        9. Mal Formación <input type="checkbox" style=" vertical-align: middle;"  name="malformacion" id="malformacion"  <?php  if($anamnesis[0]->antecedentesfamiliares[0]->malformacion==1) echo "checked"; ?> > 
                    </label>


                    <label style=" font-size: 9px !important; vertical-align: middle;"  >
                        10. Otros <input type="checkbox" style=" vertical-align: middle;"  name="otros" id="otros" <?php  if($anamnesis[0]->antecedentesfamiliares[0]->otro==1) echo "checked"; ?>  > 
                    </label>

                    <div class="col-md-12 col-xs-12">
                        <?php   echo $anamnesis[0]->antecedentesfamiliares[0]->descripcion; ?> 
                    </div>


                </td>
            </tr>
            <tr>
                <th colspan="6">4. Enfermedad O Problema Actual</th>
            </tr>

            <tr>
                <td colspan="6">
                    <?php   echo $anamnesis[0]->enfermedadactual; ?> 
                </td>
            </tr>

            
            <!--5 revision de organas se va no pertenece a el odontograma-->
            

            <!--6. Signos Vitales Y Antropometria  se va no pertenece a el odontograma-->

            

            

            
            <!--Examen regianal se va -->


            <!--Se remplaza por el odontograma-->

            <tr>
                <th colspan="6">5. Odontograma</th>
            </tr>

            <tr>
                <td colspan="6">

                    <?php 
                        $odontograma=json_decode($anamnesis[0]->odontograma[0]->odontogramajson);
                    ?>

                    <table class="table">
                        <tr>
                            <th>Recesión</th>
                            <?php
                                foreach ($odontograma->vestibular1811 as $diente) {
                                    echo "<td>".$diente->text1."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular2128 as $diente) {
                                    echo "<td>".$diente->text1."</td>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th>Movilidad</th>
                            <?php
                                foreach ($odontograma->vestibular1811 as $diente) {
                                    echo "<td>".$diente->text2."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular2128 as $diente) {
                                    echo "<td>".$diente->text2."</td>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th></th>
                            <?php
                                foreach ($odontograma->vestibular1811 as $diente) {
                                    echo "<td>".$diente->id_numero."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular2128 as $diente) {
                                    echo "<td>".$diente->id_numero."</td>";
                                }
                            ?>
                        </tr>

                        <tr>
                            <th>Vestibular</th>
                             <?php
                                foreach ($odontograma->vestibular1811 as $diente) {
                                    echo "<td>
                                            <div class='diente".$diente->id_numero."' style='width: 23px height:23px; border:1px solid white;'>
                                                <div class='diente".$diente->id_numero."_arriba'     style='background:".$diente->arriba_color."'></div>
                                                <div class='diente".$diente->id_numero."_abajo'      style='background:".$diente->abajo_color."'></div>
                                                <div class='diente".$diente->id_numero."_derecha'    style='background:".$diente->derecha_color."'></div>
                                                <div class='diente".$diente->id_numero."_izquierda'  style='background:".$diente->izquierda_color."'></div>
                                                <div class='diente".$diente->id_numero."_centro'     style='background:".$diente->centro_color."'></div>
                                            </div>
                                         </td>";


                                        echo "
                                            <style type='text/css'>
                                                .diente".$diente->id_numero."_arriba{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_abajo{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-top: 10px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_izquierda{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: left;
                                                    
                                                    position: absolute;
                                                }
                                                .diente".$diente->id_numero."_derecha{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: right;
                                                    position: absolute;   
                                                }
                                                .diente".$diente->id_numero."_centro{
                                                    border: 1px solid black;
                                                    height:10px;
                                                    width: 15px;
                                                    margin-top: -15px;
                                                    margin-left: 2.5px;
                                                }

                                            </style>
                                        ";
                                }
                            ?>

                            <td></td>
                            <td></td>
                               <?php
                                foreach ($odontograma->vestibular2128 as $diente) {
                                    echo "<td>
                                            <div class='diente".$diente->id_numero."' style='width: 23px height:23px; border:1px solid white;'>
                                                <div class='diente".$diente->id_numero."_arriba'     style='background:".$diente->arriba_color."'></div>
                                                <div class='diente".$diente->id_numero."_abajo'      style='background:".$diente->abajo_color."'></div>
                                                <div class='diente".$diente->id_numero."_derecha'    style='background:".$diente->derecha_color."'></div>
                                                <div class='diente".$diente->id_numero."_izquierda'  style='background:".$diente->izquierda_color."'></div>
                                                <div class='diente".$diente->id_numero."_centro'     style='background:".$diente->centro_color."'></div>
                                            </div>
                                         </td>";


                                        echo "
                                            <style type='text/css'>
                                                .diente".$diente->id_numero."_arriba{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_abajo{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-top: 10px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_izquierda{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: left;
                                                    
                                                    position: absolute;
                                                }
                                                .diente".$diente->id_numero."_derecha{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: right;
                                                    position: absolute;   
                                                }
                                                .diente".$diente->id_numero."_centro{
                                                    border: 1px solid black;
                                                    height:10px;
                                                    width: 15px;
                                                    margin-top: -15px;
                                                    margin-left: 2.5px;
                                                }

                                            </style>
                                        ";
                                }
                            ?>
                        </tr>
                        <tr>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular2128 as $diente) {
                                    echo "<td>";
                                    foreach ($diente->tratamiento as $t) {
                                        echo "<img src='http://athan.developerandsystem.com/upload/Odontologia/Tratamientos/".$t.".png'  height='10' width='10'/>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular2128 as $diente) {
                                    echo "<td>";
                                    foreach ($diente->tratamiento as $t) {
                                        echo "<img src='http://athan.developerandsystem.com/upload/Odontologia/Tratamientos/".$t.".png'  height='10' width='10'/>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual5551 as $diente) {
                                    echo "<td>".$diente->id_numero."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual6165 as $diente) {
                                    echo "<td>".$diente->id_numero."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Lingual</th>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual5551 as $diente) {
                                    echo "<td>
                                            <div class='diente".$diente->id_numero."' style='width: 23px height:23px; border:1px solid white;'>
                                                <div class='diente".$diente->id_numero."_arriba'     style='background:".$diente->arriba_color."'></div>
                                                <div class='diente".$diente->id_numero."_abajo'      style='background:".$diente->abajo_color."'></div>
                                                <div class='diente".$diente->id_numero."_derecha'    style='background:".$diente->derecha_color."'></div>
                                                <div class='diente".$diente->id_numero."_izquierda'  style='background:".$diente->izquierda_color."'></div>
                                                <div class='diente".$diente->id_numero."_centro'     style='background:".$diente->centro_color."'></div>
                                            </div>
                                         </td>";


                                        echo "
                                            <style type='text/css'>
                                                .diente".$diente->id_numero."_arriba{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_abajo{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-top: 10px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_izquierda{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: left;
                                                    
                                                    position: absolute;
                                                }
                                                .diente".$diente->id_numero."_derecha{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: right;
                                                    position: absolute;   
                                                }
                                                .diente".$diente->id_numero."_centro{
                                                    border: 1px solid black;
                                                    height:10px;
                                                    width: 15px;
                                                    margin-top: -15px;
                                                    margin-left: 2.5px;
                                                }

                                            </style>
                                        ";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual6165 as $diente) {
                                    echo "<td>
                                            <div class='diente".$diente->id_numero."' style='width: 23px height:23px; border:1px solid white;'>
                                                <div class='diente".$diente->id_numero."_arriba'     style='background:".$diente->arriba_color."'></div>
                                                <div class='diente".$diente->id_numero."_abajo'      style='background:".$diente->abajo_color."'></div>
                                                <div class='diente".$diente->id_numero."_derecha'    style='background:".$diente->derecha_color."'></div>
                                                <div class='diente".$diente->id_numero."_izquierda'  style='background:".$diente->izquierda_color."'></div>
                                                <div class='diente".$diente->id_numero."_centro'     style='background:".$diente->centro_color."'></div>
                                            </div>
                                         </td>";


                                        echo "
                                            <style type='text/css'>
                                                .diente".$diente->id_numero."_arriba{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_abajo{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-top: 10px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_izquierda{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: left;
                                                    
                                                    position: absolute;
                                                }
                                                .diente".$diente->id_numero."_derecha{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: right;
                                                    position: absolute;   
                                                }
                                                .diente".$diente->id_numero."_centro{
                                                    border: 1px solid black;
                                                    height:10px;
                                                    width: 15px;
                                                    margin-top: -15px;
                                                    margin-left: 2.5px;
                                                }

                                            </style>
                                        ";
                                }
                            ?>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual5551 as $diente) {
                                    echo "<td>";
                                    foreach ($diente->tratamiento as $t) {
                                        echo "<img src='http://athan.developerandsystem.com/upload/Odontologia/Tratamientos/".$t.".png'  height='10' width='10'/>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual6165 as $diente) {
                                    echo "<td>";
                                    foreach ($diente->tratamiento as $t) {
                                        echo "<img src='http://athan.developerandsystem.com/upload/Odontologia/Tratamientos/".$t.".png'  height='10' width='10'/>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual8581 as $diente) {
                                    echo "<td>".$diente->id_numero."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual7175 as $diente) {
                                    echo "<td>".$diente->id_numero."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                        </tr>



                        <tr>
                            <th>Lingual</th>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual8581 as $diente) {
                                    echo "<td>
                                            <div class='diente".$diente->id_numero."' style='width: 23px height:23px; border:1px solid white;'>
                                                <div class='diente".$diente->id_numero."_arriba'     style='background:".$diente->arriba_color."'></div>
                                                <div class='diente".$diente->id_numero."_abajo'      style='background:".$diente->abajo_color."'></div>
                                                <div class='diente".$diente->id_numero."_derecha'    style='background:".$diente->derecha_color."'></div>
                                                <div class='diente".$diente->id_numero."_izquierda'  style='background:".$diente->izquierda_color."'></div>
                                                <div class='diente".$diente->id_numero."_centro'     style='background:".$diente->centro_color."'></div>
                                            </div>
                                         </td>";


                                        echo "
                                            <style type='text/css'>
                                                .diente".$diente->id_numero."_arriba{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_abajo{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-top: 10px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_izquierda{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: left;
                                                    
                                                    position: absolute;
                                                }
                                                .diente".$diente->id_numero."_derecha{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: right;
                                                    position: absolute;   
                                                }
                                                .diente".$diente->id_numero."_centro{
                                                    border: 1px solid black;
                                                    height:10px;
                                                    width: 15px;
                                                    margin-top: -15px;
                                                    margin-left: 2.5px;
                                                }

                                            </style>
                                        ";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual7175 as $diente) {
                                    echo "<td>
                                            <div class='diente".$diente->id_numero."' style='width: 23px height:23px; border:1px solid white;'>
                                                <div class='diente".$diente->id_numero."_arriba'     style='background:".$diente->arriba_color."'></div>
                                                <div class='diente".$diente->id_numero."_abajo'      style='background:".$diente->abajo_color."'></div>
                                                <div class='diente".$diente->id_numero."_derecha'    style='background:".$diente->derecha_color."'></div>
                                                <div class='diente".$diente->id_numero."_izquierda'  style='background:".$diente->izquierda_color."'></div>
                                                <div class='diente".$diente->id_numero."_centro'     style='background:".$diente->centro_color."'></div>
                                            </div>
                                         </td>";


                                        echo "
                                            <style type='text/css'>
                                                .diente".$diente->id_numero."_arriba{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_abajo{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-top: 10px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_izquierda{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: left;
                                                    
                                                    position: absolute;
                                                }
                                                .diente".$diente->id_numero."_derecha{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: right;
                                                    position: absolute;   
                                                }
                                                .diente".$diente->id_numero."_centro{
                                                    border: 1px solid black;
                                                    height:10px;
                                                    width: 15px;
                                                    margin-top: -15px;
                                                    margin-left: 2.5px;
                                                }

                                            </style>
                                        ";
                                }
                            ?>
                            <td></td>
                            <td></td>
                        </tr>


                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual8581 as $diente) {
                                    echo "<td>";
                                    foreach ($diente->tratamiento as $t) {
                                        echo "<img src='http://athan.developerandsystem.com/upload/Odontologia/Tratamientos/".$t.".png'  height='10' width='10'/>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->lingual7175 as $diente) {
                                    echo "<td>";
                                    foreach ($diente->tratamiento as $t) {
                                        echo "<img src='http://athan.developerandsystem.com/upload/Odontologia/Tratamientos/".$t.".png'  height='10' width='10'/>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                        </tr>
                        
                             
                        <tr>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular4841 as $diente) {
                                    echo "<td>".$diente->id_numero."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular3138 as $diente) {
                                    echo "<td>".$diente->id_numero."</td>";
                                }
                            ?>
                        </tr>

                        <tr>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular4841 as $diente) {
                                     echo "<td>
                                            <div class='diente".$diente->id_numero."' style='width: 23px height:23px; border:1px solid white;'>
                                                <div class='diente".$diente->id_numero."_arriba'     style='background:".$diente->arriba_color."'></div>
                                                <div class='diente".$diente->id_numero."_abajo'      style='background:".$diente->abajo_color."'></div>
                                                <div class='diente".$diente->id_numero."_derecha'    style='background:".$diente->derecha_color."'></div>
                                                <div class='diente".$diente->id_numero."_izquierda'  style='background:".$diente->izquierda_color."'></div>
                                                <div class='diente".$diente->id_numero."_centro'     style='background:".$diente->centro_color."'></div>
                                            </div>
                                         </td>";


                                        echo "
                                            <style type='text/css'>
                                                .diente".$diente->id_numero."_arriba{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_abajo{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-top: 10px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_izquierda{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: left;
                                                    
                                                    position: absolute;
                                                }
                                                .diente".$diente->id_numero."_derecha{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: right;
                                                    position: absolute;   
                                                }
                                                .diente".$diente->id_numero."_centro{
                                                    border: 1px solid black;
                                                    height:10px;
                                                    width: 15px;
                                                    margin-top: -15px;
                                                    margin-left: 2.5px;
                                                }

                                            </style>
                                        ";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular3138 as $diente) {
                                     echo "<td>
                                            <div class='diente".$diente->id_numero."' style='width: 23px height:23px; border:1px solid white;'>
                                                <div class='diente".$diente->id_numero."_arriba'     style='background:".$diente->arriba_color."'></div>
                                                <div class='diente".$diente->id_numero."_abajo'      style='background:".$diente->abajo_color."'></div>
                                                <div class='diente".$diente->id_numero."_derecha'    style='background:".$diente->derecha_color."'></div>
                                                <div class='diente".$diente->id_numero."_izquierda'  style='background:".$diente->izquierda_color."'></div>
                                                <div class='diente".$diente->id_numero."_centro'     style='background:".$diente->centro_color."'></div>
                                            </div>
                                         </td>";


                                        echo "
                                            <style type='text/css'>
                                                .diente".$diente->id_numero."_arriba{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_abajo{
                                                    border: 1px solid black;
                                                    height:2px;
                                                    width: 15px;
                                                    margin-top: 10px;
                                                    margin-left: 2.5px;
                                                }
                                                .diente".$diente->id_numero."_izquierda{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: left;
                                                    
                                                    position: absolute;
                                                }
                                                .diente".$diente->id_numero."_derecha{
                                                    border: 1px solid black;
                                                    height:15px;
                                                    width: 2px;
                                                    float: right;
                                                    position: absolute;   
                                                }
                                                .diente".$diente->id_numero."_centro{
                                                    border: 1px solid black;
                                                    height:10px;
                                                    width: 15px;
                                                    margin-top: -15px;
                                                    margin-left: 2.5px;
                                                }

                                            </style>
                                        ";
                                }
                            ?>
                        </tr>


                        <tr>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular4841 as $diente) {
                                    echo "<td>";
                                    foreach ($diente->tratamiento as $t) {
                                        echo "<img src='http://athan.developerandsystem.com/upload/Odontologia/Tratamientos/".$t.".png'  height='10' width='10'/>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular3138 as $diente) {
                                    echo "<td>";
                                    foreach ($diente->tratamiento as $t) {
                                        echo "<img src='http://athan.developerandsystem.com/upload/Odontologia/Tratamientos/".$t.".png'  height='10' width='10'/>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                        </tr>

                        <tr>
                            <th>Movilidad</th>
                             <?php
                                foreach ($odontograma->vestibular4841 as $diente) {
                                    echo "<td>".$diente->text2."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular3138 as $diente) {
                                   echo "<td>".$diente->text2."</td>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th>Recesión</th>
                             <?php
                                foreach ($odontograma->vestibular4841 as $diente) {
                                    echo "<td>".$diente->text1."</td>";
                                }
                            ?>
                            <td></td>
                            <td></td>
                            <?php
                                foreach ($odontograma->vestibular3138 as $diente) {
                                   echo "<td>".$diente->text1."</td>";
                                }
                            ?>
                        </tr>


                          
                    </table>
                    
                </td>
            </tr>







            <tr>
                <th colspan="6">
                	8. Diagnostico
                	<i style="font-size: 9px; float: right;">(<strong>PRE</strong>= Presuntivo <strong>DEF</strong>= Definitivo)</i>
                   
                </th>
            </tr>


            <tr>
                <td colspan="6">

                	<table class="table">
                		<tr>
                			<th></th>
                			<td>CIE</td>
                			<td>PRE</td>
                			<td>DEF</td>
                			<th></th>
                			<td>CIE</td>
                			<td>PRE</td>
                			<td>DEF</td>
                		</tr>
                		

                			<?php 
                				$aux=1;
                				$cont=0;
                				foreach ($anamnesis[0]->diagnostico as $d) {
                					
                					if($aux==1){
                						echo "<tr>";
                					}

                					echo "
                						<th>".$d->cie->descripcion."</th>
			                			<th>".$d->cie->codigo."</th>
			                			<th>".$d->presuntivo."</th>
			                			<th>".$d->definitivo."</th>
                					";

                					if ($aux==2){ 
                						echo "</tr>";
                						$aux=1;
                					}

                					$aux++;
                					$cont++;
                				}

                				if(($cont % 2)==1){
                					echo "
                						<th></th>
			                			<th></th>
			                			<th></th>
			                			<th></th>
			                			</tr>
                					";
                				}
                			?>

                	</table>
                  

                </td>
            </tr>

            <tr>
                <th colspan="6">
                	9. Planes De Tratamiento
                	<i style="font-size: 9px; float: right;" >(Planes De Diagnostico, Terapéutico Y Educacional)</i>
                </th>
            </tr>

            <tr>
                <td colspan="6">
                    <?php  echo $anamnesis[0]->planestratamiento; ?>
                </td>
            </tr>


        </table>

    </div>


</body>
</html>