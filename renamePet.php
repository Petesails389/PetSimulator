<?php
include "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  renamePet($_POST['id'],$_POST['petName']);
  header("location:/");
} else{
  pageHeader();
  pageStart();
  $pet = getPet($_GET['id']);
  echo "<h2>Rename $pet[name]:</h2>";
  echo "<div class='flex'>";
  echo '<form action="renamePet.php" method="post">';
   echo "<input  type='hidden' name='id' value=$pet[id]>";
  echo "<input class='cyan' type='text' name='petName' placeholder='Pet Name'>";
  echo '<button class = "pink" type="submit">Rename Pet</button>';
  echo '</form>';
  echo "</div>";
  pageEnd();
}

?>