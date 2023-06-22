<?php

$db_name = "heroku_d1ddafa1878fd62";
$db_host = "us-cdbr-east-06.cleardb.net";
$db_user = "b8197b94fbf630";
$db_pass = "80fbdca7";

$conn = new PDO("mysql:dbname=". $db_name .";host=". $db_host, $db_user, $db_pass);

// ERROS PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


//aa