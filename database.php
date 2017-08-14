<?php
$charset = 'utf8';
$dsn = "mysql:host={$environment['MYSQL_HOST']};dbname={$environment['MYSQL_DATABASE']};charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $environment['MYSQL_USER'], $environment['MYSQL_PASSWORD'], $opt);
