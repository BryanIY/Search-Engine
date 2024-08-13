<?php

// $host = 'rdsdatabasestack-engineraydbinstancea934d2dc-pmbjat5wkcrc.cys48dm5rppb.us-east-2.rds.amazonaws.com';
// $username = 'postgres';
// $password = 'CtXrP^y-3H=2Dx1232^ORQ_peI3b,Q';

$host = "localhost:3307";
$username = "root";
$password = "";

$dbConnect=@mysqli_connect($host, $username, $password )
	or die("<p>The database server is not available!</p>");

$dbName="engineraydb";
	@mysqli_select_db($dbConnect, $dbName)
		or die("<p>Database '{$dbName}' is not available!</p>");

?>