<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "sample";
$query = "select * from prefecture";

$mysqli = new mysqli($host, $user, $pass, $database);

if ($mysqli->connect_errno) {
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

/* 文字セットを utf8 に変更します */
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
    exit();
}

for ($i=1; $i <= 10000; $i++) { 
	$query = "INSERT INTO `spot` (`id`, `name`, `tel`, `prefecture_id`, `description`) VALUES ($i, 'スポット$i', '0123-123-123', ".mt_rand(1, 47).", '紹介文$i')";

	if ($mysqli->query($query) !== TRUE) {
		print "error!";
		exit();
	}
}
	
?>