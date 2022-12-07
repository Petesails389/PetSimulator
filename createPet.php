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
  echo "<h2>Create a new pet:</h2>";
  echo "<div class='flex'>";
  echo '<form action="createPet.php" method="post">';
  echo "<input type='text' name='petName' placeholder='Pet Name'>";
  echo "<select class='cyan' name='type' value='Type of Pet'>";
  $allTypes = getAllPetTypes();
  foreach ($allTypes as $type) {
    $typeName = ucfirst($type['name']);
    echo "<option value='$type[id]'>$typeName</option>";
  }
  echo "</select>";
  echo '<button class="pink" type="submit">Create Pet</button>';
  echo '</form>';
  echo "</div>";
  pageEnd();
}

?>