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
<script type="text/javascript">
	function Edad(fecha) {
		return "holaaaaaaa";
	}
</script>
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

            <tr>
                <th colspan="6">
                	5. Revisiòn Actual De Òrganos Y Sistemas
                	<i style="font-size: 9px; float: right;">(<strong>CP</strong>= Con evidencia de patologìa  <strong>SP</strong>= Sin evidencia de patologìa)</i>
                    
                    
                </th>
            </tr>

            <tr>
                <td colspan="6" >
                    
                    <table class="table">
                    	<tr>
                    		<th></th>
                    		<th>CP</th>
                    		<th>SP</th>
                    		<th></th>
                    		<th>CP</th>
                    		<th>SP</th>
                    		<th></th>
                    		<th>CP</th>
                    		<th>SP</th>
                    		<th></th>
                    		<th>CP</th>
                    		<th>SP</th>
                    		<th></th>
                    		<th>CP</th>
                    		<th>SP</th>
                    	</tr>
                    	<tr>
                    		<th style="font-size: 9px !important;"> 1 Òrganos De Los Sentidos  </th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->sentidos_cp; ?> </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->sentidos_sp; ?> </td>
                    		<th style="font-size: 9px !important;">3 Cardio Vascular</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->vascular_cp; ?> </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->vascular_sp; ?> </td>
                    		<th style="font-size: 9px !important;" >5 Genital</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->genital_cp; ?>   </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->genital_sp; ?>   </td>
                    		<th style="font-size: 9px !important;">7 Mùsculo Esquelètico</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->mesqueletico_cp; ?> </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->mesqueletico_sp; ?> </td>
                    		<th style="font-size: 9px !important;" >9 Hemo Limfàtico</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->linfatico_cp; ?> </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->linfatico_sp; ?> </td>
                    	</tr>
                    	<tr>
                    		<th style="font-size: 9px !important;">2 Respiratorio</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->respiratorio_cp; ?> </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->respiratorio_sp; ?> </td>
                    		<th style="font-size: 9px !important;">4 Digestivo</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->digestivo_cp; ?> </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->digestivo_sp; ?> </td>
                    		<th style="font-size: 9px !important;">6 Urinario</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->urinario_cp; ?> </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->urinario_sp; ?> </td>
                    		<th style="font-size: 9px !important;">8 Endocrino</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->endocrino_cp; ?>  </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->endocrino_sp; ?>  </td>
                    		<th style="font-size: 9px !important;">10 Nervioso</th>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->nervioso_cp; ?> </td>
                    		<td><?php  echo $anamnesis[0]->organossistemas[0]->nervioso_sp; ?> </td>
                    	</tr>
                    </table>

                    <?php  echo $anamnesis[0]->organossistemas[0]->descripcion; ?>


                </td>
            </tr>

            <tr>
                <th colspan="6">6. Signos Vitales Y Antropometria</th>
            </tr>

            <tr>
                <td colspan="6">

                	
                	<table class="table">
                		<tr>
                			<th style="font-size: 9px !important;">Fecha De Mediciòn</th>
                			<td colspan="2">
                				<?php  echo $anamnesis[0]->signosvitales[0]->fechamedicion; ?> 
                			</td>

                			<th style="font-size: 9px !important;">Pulso min</th>
                			<td><?php  echo $anamnesis[0]->signosvitales[0]->pulso; ?> </td>

                		</tr>

                		<tr>
                			<th style="font-size: 9px !important;">Temperatura °C</th>
                			<td colspan="2">
                				<?php  echo $anamnesis[0]->signosvitales[0]->temperatura; ?> 
                			</td>

                			<th style="font-size: 9px !important;">Frecuencia Respiratoria</th>
                			<td>
                				<?php  echo $anamnesis[0]->signosvitales[0]->frerespiratoria; ?> 
                			</td>
                		</tr>
                		<tr>
                			<th style="font-size: 9px !important;">Presiòn Arterial</th>
                			<td>
                				<?php  echo $anamnesis[0]->signosvitales[0]->presionarterial; ?>  
                			</td>
                			<td>
                				<!--campo pendiente-->
                			</td>

                			<th style="font-size: 9px !important;">Peso kg</th>
                			<td><?php  echo $anamnesis[0]->signosvitales[0]->peso; ?> </td>
                		</tr>
                		<tr>
                			<th style="font-size: 9px !important;">Talla cm</th>
                			<td colspan="4"><?php  echo $anamnesis[0]->signosvitales[0]->talla; ?> </td>
                		</tr>
                	</table>
                    

                </th>
            </tr>


            <tr>
                <th colspan="6">
                	7. Examen Fìsico Regional
                	<i style="font-size: 9px; float: right;">(<strong>CP</strong>= Con evidencia de patologìa <strong>SP</strong>= Sin evidencia de patologìa)</i>
                    
                </th>
            </tr>

            <tr>
                <td colspan="6">

                	<table class="table">
                		<tr>
                			<th></th>
                			<th>CP</th>
                			<th>SP</th>
                			<th></th>
                			<th>CP</th>
                			<th>SP</th>
                			<th></th>
                			<th>CP</th>
                			<th>SP</th>
                			<th></th>
                			<th>CP</th>
                			<th>SP</th>
                			<th></th>
                			<th>CP</th>
                			<th>SP</th>
                			<th></th>
                			<th>CP</th>
                			<th>SP</th>
                		</tr>
                		<tr>
                			<th style="font-size: 9px;">1 Cabeza</th>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->cabeza_cp; ?>  </td>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->cabeza_sp; ?>  </td>

                			<th style="font-size: 9px;">2 Cuello</th>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->cuello_cp; ?>  </td>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->cuello_sp; ?> </td>

                			<th style="font-size: 9px;">3 Tórax</th>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->torax_cp; ?> </td>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->torax_sp; ?> </td>

                			<th style="font-size: 9px;">4 Abdomen</th>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->abdomen_cp; ?>  </td>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->abdomen_sp; ?>  </td>


                			<th style="font-size: 9px;">5 Pelvis</th>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->pelvis_cp; ?>  </td>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->pelvis_sp; ?>  </td>


                			<th style="font-size: 9px;">6 Extremidades</th>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->extremidades_cp; ?>  </td>
                			<td><?php  echo $anamnesis[0]->fisicoregional[0]->extremidades_sp; ?>  </td>

                		</tr>
                	</table>
                    

                  

						<?php  echo $anamnesis[0]->fisicoregional[0]->descripcion; ?>
                 

                    

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