<?php
include "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $petId = createPet($_POST['petName'],$_POST['type']);
  addAction('feed', $petId);
  addAction('excercise', $petId);
  header("location:/");
} else{
  pageHeader();
  pageStart();
  echo "<div>";
  echo "<h2>Create a new pet:</h2>";
  echo '<form action="createPet.php" method="post">';
  echo "<input type='text' name='petName' placeholder='Pet Name'>";
  echo "<select name='type' value='Type of Pet'>";
  $allTypes = getAllPetTypes();
  foreach ($allTypes as $type) {
    $typeName = ucfirst($type['name']);
    echo "<option value='$type[id]'>$typeName</option>";
  }
  echo "</select>";
  echo '<input type="submit" value="Create Pet">';
  echo '</form>';
  pageEnd();
}

?>