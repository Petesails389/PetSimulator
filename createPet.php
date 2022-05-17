<?php
include "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  createPet($_POST['petName'],$_POST['type']);
  header("location:/");
} else{
  pageHeader();
  pageStart();
  echo "<div>";
  echo "<h2>Create a new pet:</h2>";
  echo '<form action="createPet.php" method="post">';
  echo "<input type='text' name='petName' value='Pet Name'>";
  echo "<select name='type' value='Type of Pet'>";
  echo "<option value='dog'>Dog</option>";
  echo "<option value='cat'>Cat</option>";
  echo "<option value='bird'>Bird</option>";
  echo "<option value='snake'>Snake</option>";
  echo "</select>";
  echo '<input type="submit" value="Create Pet">';
  echo '</form>';
  pageEnd();
}

?>