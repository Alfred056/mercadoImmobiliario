<?php

use App\Util\Fecha;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>Reporte</title>
</head>

<?php
// Datos
$token = 'apis-token-9479.gyvVVWdJ5l4VR70J7OAUyFgWgQPpXxnB';
$fecha = date('Y-m-d');

// Iniciar llamada a API
$curl = curl_init();

curl_setopt_array($curl, array(
  // para usar la api versión 2
  CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/tipo-cambio?date=' . $fecha,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/tipo-de-cambio-sunat-api',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// Datos listos para usar
$tipoCambioSunat = json_decode($response);
//var_dump($tipoCambioSunat);
// Extraer valores
$precioCompra = $tipoCambioSunat->precioCompra;
$precioVenta = $tipoCambioSunat->precioVenta;


?>

<body>

    <div class="container">
        <br>
        <h2 style="text-align: center;color:dimgray">Reporte Mercado Inmobiliario</h2>
        <br>
        <br>
        <!-- Data actualizada hatas 10/08/2021<p> -->

        <!--<div class="row" >
                <div class="col-sm" >
                    Desde : 
                </div>
                <div class="col-sm">
                
                        <select id="trimestre_desde" class="custom-select">
                            <option value="T1">T1</option>
                            <option value="T2">T2</option>
                            <option value="T3">T3</option>
                            <option value="T4">T4</option>
                        </select>
                </div>
                <div class="col-sm">
                    <select id="trimestre_anio" class="custom-select">
                            <?php
                            $anio_actual = Date("Y");

                            for ($i = $anio_actual; $i >= 1980; $i--) {
                            ?>
                                <option value="T1"><?php echo $i; ?></option>
                            <?php      }            ?>
                        </select>
                </div>
            </div>
            <p>
            <div class="row">
                <div class="col-sm" >
                    Hasta : 
                </div>
                <div class="col-sm">
                
                        <select id="trimestre_hasta" class="custom-select">
                            <option value="T1">T1</option>
                            <option value="T2">T2</option>
                            <option value="T3">T3</option>
                            <option value="T4">T4</option>
                        </select>
                </div>
                <div class="col-sm">
                    <select id="trimestre_anio" class="custom-select">
                            <?php
                            $anio_actual = Date("Y");

                            for ($i = $anio_actual; $i >= 1980; $i--) {
                            ?>
                                <option value="T1"><?php echo $i; ?></option>
                            <?php      }            ?>
                        </select>
                </div>
               
            </div>
        -->
        <div classs="row">
            <div class="col">
                <!--<button type="button" class="btn btn-primary">Consultar</button>-->
                <button type="button" class="btn btn-danger" onclick="print();">IMPRIMIR PDF</button>

            </div>
        </div>
        <p>
        <div class="row">
            <div class="col-sm">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"> VENTAS POR DISTRITO</li>
                    </ol>
                </nav>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Distrito</th>
                            <th scope="col">Venta($)</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i <= 11; $i++) {
                        ?>
                            <tr>
                                <th scope="row"><?= utf8_encode($distritos[$i]['serie']);   ?></th>
                                <td><?= number_format(round($ventas[$i], 2, 2), 2, '.', ' '); ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>



            </div>
            <div class="col-sm">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"> PRECIO DE M2 DISTRITO</li>
                    </ol>
                </nav>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Distrito</th>
                            <th scope="col">Precio($)</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i <= 11; $i++) {
                        ?>
                            <tr>
                                <th scope="row"><?= utf8_encode($distritos[$i]['serie']);   ?></th>
                                <td><?= number_format(round($precioM2[0], 2, 2), 2, '.', ' '); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <div class="col-sm">
                <!--TASA DE INTERES HIPOTECARIO<p>-->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">TASA DE INTERES HIPOTECARIO</li>
                    </ol>
                </nav>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Banco</th>
                            <th scope="col">TASA (%)</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataCreditoHipo as $data) {   ?>
                            <tr>
                                <th scope="row"><?php echo $data["nombre"]   ?></th>
                                <td scope="col" style="text-align: center;"><?php echo number_format($data["monto"], 2, '.', ' ');  ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">TIPO DE CAMBIO <br>ACTUALIZADO (<?php echo Date('d/m/Y');  ?>) SBS </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">VENTA</th>
                            <td><?php echo $precioVenta; ?></td>

                        </tr>
                        <tr>
                            <th scope="row">COMPRA</th>
                            <td><?php echo $precioCompra; ?></td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">MARKET SHARE</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabla_asei">
                        <thead>
                            <tr>
                                <th scope="col-2">AÑO</th>
                                <th scope="col" style="text-align: center;">MES</th>
                                <th scope="col" style="text-align: center;">ASEI</th>
                                <th scope="col" style="text-align: center;">OPTIMA</th>
                                <th scope="col" style="text-align: center;">PARTICIPACION (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $i = 0;
                            $count = sizeof($dataOsei);
                            for ($i; $i < $count; $i++) {
                                if ($dataOsei[$i]['unidades'] != '' && $dataOptima[$i]['unidades'] != '') {
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $dataOsei[$i]['anio'];   ?></th>
                                        <td style="text-align: center;"><?php echo Fecha::getNombreMes($dataOsei[$i]['mes']);   ?></td>
                                        <td style="text-align: center;"><?php echo $dataOsei[$i]['unidades'];   ?></td>
                                        <td style="text-align: center;"><?php echo $dataOptima[$i]['unidades'];   ?></td>
                                        <td style="text-align: center;"><?php echo round(($dataOptima[$i]['unidades'] / $dataOsei[$i]['unidades']) * 100) . ' %';   ?></td>
                                    </tr>
                            <?php
                                }
                            } ?>


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm">




            </div>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div id="columnchart_material" class="chart"></div>
            </div>
        </div>



    </div>

</body>
<style>
   .chart {
  width: 100%; 
  min-height: 450px;
}
</style>

<script type="text/javascript">
   
    google.charts.load('current', {packages: ['corechart']});   
    window.onload = function() {
        let rows = document.getElementById('tabla_asei').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        google.charts.setOnLoadCallback(drawChart(rows));
    };
    function drawChart(rows) {

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'mes');
        data.addColumn('number', 'ASEI');
        data.addColumn('number', 'OPTIMA');
        data.addColumn('number', 'AVANCE');

        for (i = 0; i < rows.length; i++) {
            let tr = rows[i];
            let mes = tr.cells[1];
            let asei = tr.cells[2];
            let optima = tr.cells[3];
            let avance = tr.cells[4];
            data.addRow([mes.innerText, parseInt(asei.innerText), parseInt(optima.innerText), parseInt(avance.innerText)] )
        }

    
        var options = {
               title : 'EVOLUCION DE UNIDADES VENDIDAS',
               vAxis: {title: 'Ventas'},
               hAxis: {title: 'Meses'},
               seriesType: 'bars',
               series: {2: {type: 'line'}},
               
            };

        var chart = new google.visualization.ComboChart(document.getElementById('columnchart_material'));
        chart.draw(data, options);        
        
    }
</script>

</html>