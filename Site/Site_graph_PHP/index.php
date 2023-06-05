<?php
    $db = new SQLite3('/var/www/html/sqlite.sqlite');
    $result = $db->query('SELECT * FROM data_meteo ORDER BY date ASC');
 
    $dataPoints = array();
 
    while ($product = $result->fetchArray()) {
        $timestamp = strtotime($product['date']); // Convertir la date en timestamp
        $formattedDate = date('d/m/Y H:i', $timestamp); // Convertir le timestamp en format lisible
        array_push($dataPoints, array('label' => $formattedDate, 'y' => $product['temperature']));
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
    <style>
        body{
            background-image: url('/var/www/html/imag.jpg');
        }
    </style>
    <script>
        window.onload = () => {
            let chart = new CanvasJS.Chart('chartContainer', {
                theme: 'light2',
                animationEnabled: true,
                zoomEnabled: true,
                title: {
                    text: 'Météo Mont-de-Marsan'
                },
                axisX: {
                    title: "Date",
                    labelAngle: 45 // Angle de rotation des étiquettes de l'axe X
                },
                data: [{
                    type: 'line',
                    name: 'Température (°C)',
                    showInLegend: true,
                    toolTipContent: 'Le {label}<br>Température: {y} °C',
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
    </head>
    <body>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </body>
</html>
