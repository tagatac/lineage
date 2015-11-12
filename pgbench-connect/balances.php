<!DOCTYPE html>
<html>
<head>
</head>

<body>
<?php
$username = "tag";
$database = "pgbench";

$con = pg_connect("dbname={$database} user={$username}");
if (!$con) {
    die('Could not connect: ' . pg_last_error($con));
}

$sql = "SELECT ccolor, SUM(abalance) FROM (SELECT * FROM pgbench_accounts a JOIN pgbench_tellers t ON a.tid=t.tid) accounts_tellers GROUP BY ccolor;";
$result = pg_query($con,$sql);

$balances = array();
$max_balance = 0;
while($row = pg_fetch_array($result)) {
	$balance = (int) $row['sum'];
	if ($balance > $max_balance) {$max_balance = $balance;};
	$balances[$row['ccolor']] = $balance;
}
foreach ($balances as $color => $balance) {
	$percentage = (float)$balance / (float)$max_balance * 100;
	echo "<div id=\"{$color}\" style=\"width:{$percentage}%;\" onclick=\"schart('{$color}')\">{$color}: \${$balance}</div>\n";
}
pg_close($con);
?>
</body>
</html>
