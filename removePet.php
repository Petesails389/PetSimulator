<?php
$dir = 'sqlite:/home/runner/PetSimulator/database.sqlite';
$dbh  = new PDO($dir) or die("cannot open the database");

$dbh->query("DELETE FROM pets WHERE id = $_POST[id]");

header("location:/");

?>