<?php

$db = new SQLite3('sqlite.sqlite');
$sql = "SELECT date, temperature FROM data_meteo";
$results = $db->query($sql);

$dataPoints = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $date = strtotime($row['date']) * 1000; // Conversion en millisecondes
    $temperature = $row['temperature'];
    array_push($dataPoints, array("x" => $date, "y" => $temperature));
}
 
?>
<!DOCTYPE HTML>
<html>
<head> 
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
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
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
