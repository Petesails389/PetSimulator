<?php
include "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  addAction($_POST['type'],$_POST['id']);
  header("location:/managePet.php?id=$_POST[id]");
} else{
  pageHeader();
  pageStart();
  
  $pet = getPet($_GET['id']);
  $hunger = getHunger($pet['id']);

  echo "<div>";
  echo "<h2>Currently Interacting With $pet[name]:</h2>";
  echo "<div class='box'>";
  echo "<h3>Food:</h3>";
  echo "<div>";
  echo "<div>$pet[name] is ";
  if ($hunger < 4) {
    echo "not hungry.";
  } elseif ($hunger >= 4 && $hunger < 8) {
    echo "slightly hungry";
  } elseif ($hunger >= 8 && $hunger < 16){
    echo "hungry.";
  } elseif ($hunger >= 16 && $hunger < 24) {
    echo "very hungry";
  } else {
    echo "extremely hungry.";
  }
  echo "</div>";
  echo "<div>You last fed them $hunger hours ago.</div>";
  echo '<form action="managePet.php" method="post">';
  echo "<input  type='hidden' name='type' value='feed'>";
  echo "<input  type='hidden' name='id' value=$pet[id]>";
  echo "<input type='submit' value='Feed $pet[name]'>";
  echo '</form>';
  echo "</div>";
  echo "</div>";
  pageEnd();
}

?>