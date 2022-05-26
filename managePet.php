<?php
include "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $dead = checkForDeath($_POST['id']);
  if ($dead[0] and $pet['imortal']==0) {
    kill($_POST['id'],$dead[1],$dead[2]);
  } else {
    addAction($_POST['type'],$_POST['id']);
  }
  header("location:/managePet.php?id=$_POST[id]");
} else{
  pageHeader();
  pageStart();
  
  $pet = getPet($_GET['id']);
  $dead = checkForDeath($pet['id']);
  $type = getPetType($pet['type']);
  $hunger = getHunger($pet['id']);
  $weight = getWeight($pet['id']);
  $idealWeight = $type['healthy_weight']/1000;
  $fitness = getFitness($pet['id']);
  $happiness = getHappiness($pet['id']);
  $feedTime = 8;

  if ($dead[0] && $pet['imortal'] == 0) {
    kill($pet['id'],$dead[1],$dead[2]);
  }
  
  echo "<div>";
  echo "<h2>Currently Interacting With $pet[name]:</h2>";
  if ($dead[0]) {
    echo "<div>$pet[name] is dead. :(</div>";
  } else {
    echo "<div class='box'>";
    echo "<h3>Food:</h3>";
    echo "<div>";
    echo "<div>$pet[name] is ";
    if ($hunger < 4) {
      echo "not hungry.</div>";
    } elseif ($hunger >= 4 && $hunger < 8) {
      echo "slightly hungry.</div>";
    } elseif ($hunger >= 8 && $hunger < 16){
      echo "hungry.</div>";
    } elseif ($hunger >= 16 && $hunger < 24) {
      echo "very hungry.</div>";
    } else {
      echo "extremely hungry.</div>";
    }
    $displayHunger = round($hunger,1);
    echo "<div>You last fed them $displayHunger hours ago.</div>";
    echo '<form action="managePet.php" method="post">';
    echo "<input  type='hidden' name='type' value='feed'>";
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<input type='submit' value='Feed $pet[name]'>";
    echo '</form>';
    echo "</div>";
    echo "<h3>Activities:</h3>";
    echo "<div>";
    echo '<form action="managePet.php" method="post">';
    echo "<input  type='hidden' name='type' value='excercise'>";
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<input type='submit' value='Excercise with $pet[name]'>";
    echo '</form>';
    echo '<form action="managePet.php" method="post">';
    echo "<input  type='hidden' name='type' value='play'>";
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<input type='submit' value='Play with $pet[name]'>";
    echo '</form>';
    echo "</div>";
    echo "<h3>Health:</h3>";
    echo "<div>";
    echo "<div>$pet[name] weighs $weight kg. They should weigh $idealWeight kg.</div>";
    if ($fitness<7) {
      $fit = "unfit";
    } elseif ($fitness < 15) {
      $fit = "fit";
    }
    elseif ($fitness < 30) {
      $fit = "very fit";
    } else {
      $fit = "extremely fit";
    }
    if ($happiness<7) {
      $happy = "unhappy";
    } elseif ($happiness < 15) {
      $happy = "happy";
    }
    elseif ($happiness < 30) {
      $happy = "very happy";
    } else {
      $happy = "extremely happy";
    }
    echo "<div>$pet[name] is $fit and $happy.</div>";
    echo "</div>";
    echo "</div>";
  }
  pageEnd();
}

?>