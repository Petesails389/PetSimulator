<?php
include "init.php";
pageHeader();
pageStart();
echo "<h2>Action Table</h2>";
foreach (getAllActions() as $action) {
  foreach ($action as $value) {
    echo "$value, ";
  }
  echo "<br>";
}
echo "<h2>All Pets</h2>";
foreach (getAllPets() as $pet){
  foreach($pet as $value) {
    echo "$value, ";
  }
  var_dump (CheckForDeath($pet['id']));
  echo "<br>";
}

pageEnd();
?>