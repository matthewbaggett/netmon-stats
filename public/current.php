<?php

require_once("../bootstrap.php");
require_once("../database.php");

$results = [];

foreach($pdo->query("SELECT * FROM speedtests ORDER BY `time` DESC LIMIT 1") as $speedtest){
    $results[] = $speedtest;
}

echo json_encode($results, JSON_PRETTY_PRINT);
