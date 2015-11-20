function() {
var unselected = {
	marker: {color: 'steelblue'},
	name: 'unselected',

<?php
$color = $_GET['color'];
$username = "tag";
$database = "pgbench";

$con = pg_connect("dbname={$database} user={$username}");
if (!$con) {
    die('Could not connect: ' . pg_last_error($con));
}

if ($color == 'all') {
	$sql = "SELECT aid, abalance, satisfaction FROM pgbench_accounts WHERE aid<=100;";
	$result = pg_query($con,$sql);

	$ys = array();
	echo "\tx: [";
	while($row = pg_fetch_array($result)) {
		echo "{$row['abalance']},";
		array_push($ys, $row['satisfaction']);
	}
	echo "],\n";
	echo "\ty: [";
	foreach ($ys as $yval) {
		echo "{$yval}, ";
	}
	echo "],\n\tmode: 'markers',\n\ttype: 'scatter'\n};\n";
	echo "var selected = {\tx: [],\n\ty: [],\n";

}
else {
	$sql = "SELECT abalance, satisfaction FROM (SELECT a.aid AS aid, a.abalance AS abalance, a.satisfaction AS satisfaction FROM pgbench_accounts a JOIN pgbench_tellers t ON a.tid=t.tid WHERE a.aid<=100 AND t.ccolor!=color('{$color}')) accounts_tellers;";
	$result = pg_query($con,$sql);
	$ys = array();
	echo "\tx: [";
	while($row = pg_fetch_array($result)) {
		echo "{$row['abalance']},";
		array_push($ys, $row['satisfaction']);
	}
	echo "],\n";
	echo "\ty: [";
	foreach ($ys as $yval) {
		echo "{$yval}, ";
	}
	echo "],\n\tmode: 'markers',\n\ttype: 'scatter'\n};\n";

	echo "var selected = {\n\tmarker: {color: 'red'},\n\tname: 'selected',\n";
	$sql = "SELECT abalance, satisfaction FROM (SELECT a.aid AS aid, a.abalance AS abalance, a.satisfaction AS satisfaction FROM pgbench_accounts a JOIN pgbench_tellers t ON a.tid=t.tid WHERE a.aid<=100 AND t.ccolor=color('{$color}')) accounts_tellers;";
	$result = pg_query($con,$sql);
	$ys = array();
	echo "\tx: [";
	while($row = pg_fetch_array($result)) {
		echo "{$row['abalance']},";
		array_push($ys, $row['satisfaction']);
	}
	echo "],\n";
	echo "\ty: [";
	foreach ($ys as $yval) {
		echo "{$yval}, ";
	}
	echo "],\n";
}
pg_close($con);
?>
  mode: 'markers',
  type: 'scatter'
};

var data = [unselected, selected];
var layout = {showlegend: true};
Plotly.newPlot('scatter', data, layout);
}()
