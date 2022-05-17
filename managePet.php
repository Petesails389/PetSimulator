<?php
include "init.php";

$user = getUserId();
$username = getUser();
$petId = $_GET['id'];
$petInfo = getPetInfo($petId)[0];

pageHeader();
pageStart();

echo "<h2>You Are Currently With $petInfo[name]!</h2>";
echo "<div>";
echo "$petInfo[name] is a $petInfo[type].";
echo "<br>";
echo "Their birthday is $petInfo[birthday].";
echo "</div>";

pageEnd();
$dbh = null;

?>