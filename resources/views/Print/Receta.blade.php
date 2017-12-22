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
<body>
<div class="container" >
    <div class="col-xs-6" >

         <table class="table table-bordered ">
            <tr>
                <th>Ciudad</th>
                <td><?php echo $receta[0]->prescripcion->consultaexterna->agenda->empresa->ciudad->descripcion; ?></td>
                <th>Fecha</th>
                <td><?php echo $receta[0]->prescripcion->fecha; ?></td>
            </tr>
            <tr>
               <th>Paciente</th> 
               <td colspan="3"><?php echo $receta[0]->prescripcion->consultaexterna->agenda->cliente->persona->apellido." ".$receta[0]->prescripcion->consultaexterna->agenda->cliente->persona->nombre; ?></td>
            </tr>
            <tr>
                <th>C.I. Paciente</th>
                <td colspan="3"><?php echo $receta[0]->prescripcion->consultaexterna->agenda->cliente->persona->ci; ?></td>
            </tr>
            <tr>
                <th>Número De Historia Clinica</th>
                <td colspan="3"><?php echo $receta[0]->prescripcion->consultaexterna->agenda->cliente->numerohistoria; ?></td>
            </tr>
            <tr>
                <th colspan="4">Medicamentos</th>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                        echo "<table class='table'>";
                        foreach ($receta as $d) {
                            echo "<tr>";
                                echo "<td>".$d->item->descripcion."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                     ?>
                </td>
            </tr>
            <tr>
                <th colspan="4">Dosis</th>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                        echo "<table class='table'>";
                        foreach ($receta as $d) {
                            echo "<tr>";
                                echo "<td>".$d->cantidad."</td><td>".$d->item->descripcion."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                     ?>
                </td>
            </tr>
        </table>

    </div>
    <div class="col-xs-6">

         <table border="0" style="width: 100%; border: 1px solid #ddd;" >
           <tr>
               <th>Indicaciones</th>
           </tr>
           <tr>
               <td style='height: 15%; '>
                   <?php
                        echo "<table>";
                        foreach ($receta as $d) {
                            echo "<tr>";
                                echo "<td>".$d->item->descripcion."</td><td>".$d->indicaciones."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    ?>
               </td>
           </tr>
        </table>

    </div>    
</div>
</body>
</html>