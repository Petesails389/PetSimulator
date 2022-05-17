<?php
include "init.php";

$user = getUserId();
$username = getUser();
$pets = getPets();
$dbh = null;

if (isLoggedIn()){
  header("location:/petList.php");
  exit;
} else{
  pageHeader();
  pageStart();
  pageEnd();
}
?>

