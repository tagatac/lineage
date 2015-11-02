<!DOCTYPE html>
<html>
<head>
</head>

<body>
<?php
$color = $_GET['color'];
$username = "tag";
$database = "pgbench";

$con = pg_connect("dbname={$database} user={$username}");
if (!$con) {
    die('Could not connect: ' . pg_last_error($con));
}

if ($color == 'all') {
	$sql = "SELECT bid, AVG(satisfaction) FROM pgbench_accounts GROUP BY bid;";
}
else {
	$sql = "SELECT bid, AVG(satisfaction) FROM (SELECT a.bid AS bid, a.satisfaction AS satisfaction FROM pgbench_accounts a JOIN pgbench_tellers t ON a.tid=t.tid WHERE t.ccolor=color('{$color}')) accounts_tellers GROUP BY bid;";
}
$result = pg_query($con,$sql);

$averages = array();
$max_average = 0;
while($row = pg_fetch_array($result)) {
	$average = (float) $row['avg'];
	if ($average > $max_average) {$max_average = $average;};
	$averages[$row['bid']] = $average;
}
$max_average -= 5.4;
foreach (range(1,10) as $i) {
	$average = $averages[$i];
	$percentage = ($average - 5.4) / .2 * 100;
	echo "<div id=\"{$i}\" style=\"width:{$percentage}%;\">Bank #{$i}: {$average}</div>\n";
}
pg_close($con);
?>
</body>
</html>
