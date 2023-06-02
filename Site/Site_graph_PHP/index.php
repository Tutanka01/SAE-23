<?php

$db = new SQLite3('/var/www/html/sqlite.sqlite');
// la date en ascendant
$sql = "SELECT date, temperature FROM data_meteo ORDER BY date ASC";
$results = $db->query($sql);

$dataPoints = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $date = strtotime($row['date']) * 1000; // Conversion en millisecondes
    $temperature = $row['temperature'];
    array_push($dataPoints, array("x" => $date, "y" => $temperature));
}
//pression
$sql = "SELECT date, pression FROM data_meteo ORDER BY date ASC";
$results = $db->query($sql);
$dataPoints_pression = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $date = strtotime($row['date']) * 1000; // Conversion en millisecondes
    $pression = $row['pression'];
    array_push($dataPoints_pression, array("x" => $date, "y" => $pression));
}
//humidite
$sql = "SELECT date, humidite FROM data_meteo ORDER BY date ASC";
$results = $db->query($sql);
$dataPoints_humidite = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
	$date = strtotime($row['date']) * 1000; // Conversion en millisecondes
	$humidite = $row['humidite'];
	array_push($dataPoints_humidite, array("x" => $date, "y" => $humidite));
}

?>
<!DOCTYPE HTML>
<html>
<head> 
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {

    var chart1 = new CanvasJS.Chart("chartContainer", {
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        animationEnabled: true,
        zoomEnabled: true,
        title: {
            text: "Température en fonction de la date"
        },
        axisX: {
            title: "Date",
            valueFormatString: "YYYY-MM-DD HH:mm:ss"
        },
        axisY: {
            title: "Température"
        },
        data: [{
            type: "area",     
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });

    // en fonction de la pression

    var chart2 = new CanvasJS.Chart("chartContainer2", {
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        animationEnabled: true,
        zoomEnabled: true,
        title: {
            text: "Pression en fonction de la date"
        },
        axisX: {
            title: "Date",
            valueFormatString: "YYYY-MM-DD HH:mm:ss"
        },
        axisY: {
            title: "Pression"
        },
        data: [{
            type: "area",     
            dataPoints: <?php echo json_encode($dataPoints_pression, JSON_NUMERIC_CHECK); ?>
        }]
    });

	var chart3 = new CanvasJS.Chart("chartContainer3", {
		theme: "light1", // "light1", "light2", "dark1", "dark2"
		animationEnabled: true,
		zoomEnabled: true,
		title: {
			text: "Humidite en fonction de la date"
		},
		axisX: {
			title: "Date",
			valueFormatString: "YYYY-MM-DD HH:mm:ss"
		},
		axisY: {
			title: "Humidite"
		},
		data: [{
			type: "area",     
			dataPoints: <?php echo json_encode($dataPoints_humidite, JSON_NUMERIC_CHECK); ?>
		}]
	});

    chart1.render();
    chart2.render();
	chart3.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="width: 45%; height: 300px;display: inline-block;"></div>

<div id="chartContainer2" style="width: 45%; height: 300px;display: inline-block;"></div>

<div id="chartContainer3" style="width: 45%; height: 300px;display: inline-block;"></div>

<button onclick="window.print()">Imprimer</button> <!-- Bouton d'impression , possibilite 1-->
<button onclick = "window.location.href='script_pdf.php';"> Imprimer PHP</button>


</body>
</html>
