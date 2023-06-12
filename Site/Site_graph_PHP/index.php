<?php

if (isset($_POST['date1']) && isset($_POST['date2'])) {
    $date = $_POST['date1'];
    $date2 = $_POST['date2'];
    // Connexion à la base de données SQLite
    $db = new SQLite3('/var/www/html/sqlite.sqlite');
    // temperature
    $result = $db->query("SELECT * FROM data_meteo WHERE date BETWEEN '$date' AND '$date2' ORDER BY date ASC");
    $dataPoints = array();
    while ($product = $result->fetchArray()) {
        $timestamp = strtotime($product['date']); // Convertir la date en timestamp
        $formattedDate = date('d/m/Y H:i', $timestamp); // Convertir le timestamp en format lisible
        array_push($dataPoints, array('label' => $formattedDate, 'y' => $product['temperature']));
    }
    //  humidite
    $result = $db->query("SELECT * FROM data_meteo WHERE date BETWEEN '$date' AND '$date2' ORDER BY date ASC");
    $dataPoints2 = array();
    while ($product = $result->fetchArray()) {
        $timestamp = strtotime($product['date']); // Convertir la date en timestamp
        $formattedDate = date('d/m/Y H:i', $timestamp); // Convertir le timestamp en format lisible
        array_push($dataPoints2, array('label' => $formattedDate, 'y' => $product['humidite']));
    }
    // pression
    $result = $db->query("SELECT * FROM data_meteo WHERE date BETWEEN '$date' AND '$date2' ORDER BY date ASC");
    $dataPoints3 = array();
    while ($product = $result->fetchArray()) {
        $timestamp = strtotime($product['date']); // Convertir la date en timestamp
        $formattedDate = date('d/m/Y H:i', $timestamp); // Convertir le timestamp en format lisible
        array_push($dataPoints3, array('label' => $formattedDate, 'y' => $product['pression']));
    }
} else {
    // Connexion à la base de données SQLite
    $db = new SQLite3('/var/www/html/sqlite.sqlite');
    // temperature
    $result = $db->query('SELECT * FROM data_meteo ORDER BY date ASC');
    $dataPoints = array();
    while ($product = $result->fetchArray()) {
        $timestamp = strtotime($product['date']); // Convertir la date en timestamp
        $formattedDate = date('d/m/Y H:i', $timestamp); // Convertir le timestamp en format lisible
        array_push($dataPoints, array('label' => $formattedDate, 'y' => $product['temperature']));
    }
    //  humidite
    $result = $db->query('SELECT * FROM data_meteo ORDER BY date ASC');
    $dataPoints2 = array();
    while ($product = $result->fetchArray()) {
        $timestamp = strtotime($product['date']); // Convertir la date en timestamp
        $formattedDate = date('d/m/Y H:i', $timestamp); // Convertir le timestamp en format lisible
        array_push($dataPoints2, array('label' => $formattedDate, 'y' => $product['humidite']));
    }
    // pression
    $result = $db->query('SELECT * FROM data_meteo ORDER BY date ASC');
    $dataPoints3 = array();
    while ($product = $result->fetchArray()) {
        $timestamp = strtotime($product['date']); // Convertir la date en timestamp
        $formattedDate = date('d/m/Y H:i', $timestamp); // Convertir le timestamp en format lisible
        array_push($dataPoints3, array('label' => $formattedDate, 'y' => $product['pression']));
    } 
}

?>

<!DOCTYPE HTML>
<html>
    <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>Site Graphique</title>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = () => {
            let chart = new CanvasJS.Chart('chartContainer', {
                theme: 'light2',
                backgroundColor: 'RGBA(245,245,245,0.75)',
                animationEnabled: true,
                zoomEnabled: true,
                title: {
                    text: 'Temperature a Mont-de-Marsan'
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
            let chart2 = new CanvasJS.Chart('chartContainer2', {
                theme: 'light2',
                backgroundColor: 'RGBA(245,245,245,0.75)',
                animationEnabled: true,
                zoomEnabled: true,
                title: {
                    text: 'Humidite a Mont-de-Marsan'
                },
                axisX: {
                    title: "Date",
                    labelAngle: 45 // Angle de rotation des étiquettes de l'axe X
                },
                data: [{
                    type: 'line',
                    name: 'Humidité (%)',
                    showInLegend: true,
                    toolTipContent: 'Le {label}<br>Humidité: {y} %',
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            let chart3 = new CanvasJS.Chart('chartContainer3', {
                theme: 'light2',
                backgroundColor: 'RGBA(245,245,245,0.75)',
                animationEnabled: true,
                zoomEnabled: true,
                title: {
                    text: 'Pression a Mont-de-Marsan'
                },
                axisX: {
                    title: "Date",
                    labelAngle: 45 // Angle de rotation des étiquettes de l'axe X
                },
                data: [{
                    type: 'line',
                    name: 'Pression (hPa)',
                    showInLegend: true,
                    toolTipContent: 'Le {label}<br>Pression: {y} hPa',
                    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
            chart2.render();
            chart3.render();
        }
    </script>
    </head>
    <body>
        <h1>Graphiques de Temperature/Humidite/Pression</h1>

        <?
            // Formulaire pour le choix de la date entre 2 dates différentes
            // Centrer au millueay de la page avec un petit titre
            echo "<h2 style='text-align:center;'>Choisir une date</h2>";
            echo "<div style='display:flex; justify-content:center; align-items:center;'>";
                echo "<form method='post' action='index.php'>";
                    echo "<input type='date' name='date1'>";
                    echo "<input type='date' name='date2'>";
                    echo "<input type='submit' value='Valider'>";
                echo "</form>";
            echo "</div>";
        ?>

        <div style="margin: 50px; align-items: center;">
            <div id="chartContainer" style="width: 45%; height: 300px; display: inline-block;"></div>
            <div id="chartContainer2" style="width: 45%; height: 300px; display: inline-block;"></div>
            <div style="display:flex; justify-content:center; align-items:center;">    
                <div id="chartContainer3" style="width: 45%; height: 300px; display: inline-block;"></div>
            </div>
            <div style="display:flex; justify-content:center; align-items:center;">  
                <button onclick="window.print()">Imprimer</button> <!-- Bouton d'impression, possibilité 1 -->
            </div>

            <?php
                // Lister par date la temperature l'humidite et la pression
                echo "<h1>Historique des données</h1>";
                $result = $db->query('SELECT * FROM data_meteo ORDER BY date ASC');
                $counter = 1;
                while ($product = $result->fetchArray()) {
                    $timestamp = strtotime($product['date']); // Convertir la date en timestamp
                    $formattedDate = date('d/m/Y H:i', $timestamp); // Convertir le timestamp en format lisible

                    echo '<div class="table-container">';
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Date</th>';
                    echo '<th>Temperature (°C)</th>';
                    echo '<th>Humidite (%)</th>';
                    echo '<th>Pression (hpa)</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>' . $formattedDate . '</td>';
                    echo '<td>' . $product['temperature'] . '</td>';
                    echo '<td>' . $product['humidite'] . '</td>';
                    echo '<td>' . $product['pression'] . '</td>';
                    echo '</tr>';
                    echo '</table>';
                    echo '</div>';

                    if ($counter % 3 == 0) {
                        echo '<br>'; // Saut de ligne après chaque groupe de 3 tableaux
                    }

                    $counter++;
                }
            ?>
        </style=>
    </body>
</html>
