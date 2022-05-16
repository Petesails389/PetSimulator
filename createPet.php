<?php
include "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  createPet($_POST['petName']);
  header("location:/");
} else{
  echo "<div>";
  echo "<h2>Create a new pet:</h2>";
  echo '<form action="createPet.php" method="post">';
  echo "<input type='text' name='petName' value='Pet Name'>";
  echo '<input type="submit" value="Create Pet">';
  echo '</form>';
}

?>