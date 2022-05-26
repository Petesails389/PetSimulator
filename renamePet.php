<?php
include "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  renamePet($_POST['id'],$_POST['petName']);
  header("location:/");
} else{
  pageHeader();
  pageStart();
  $pet = getPet($_GET['id']=1);
  echo "<div>";
  echo "<h2>Rename $pet[name]:</h2>";
  echo '<form action="renamePet.php" method="post">';
   echo "<input  type='hidden' name='id' value=$pet[id]>";
  echo "<input type='text' name='petName' placeholder='Pet Name'>";
  echo '<input type="submit" value="Rename Pet">';
  echo '</form>';
  pageEnd();
}

?>