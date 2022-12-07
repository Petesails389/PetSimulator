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
  echo "<h2>You're Playing With $pet[name]:</h2>";
  if ($dead[0]) {
    echo "<div>$pet[name] is dead. :(</div>";
    echo "</div>";
  } else {
    //hunger - time since feed
    $percent = ($hunger / 48) * 100; //anothing longer than 48 hours will display max hunger
    $averageExcercise = getAverageActivityTime($pet['id'], "excercise")/60/60;
    //$p1 = min($percent,min($averageExcercise,8)); //displays the first bit in a lighter colour to show that it's within the healthy range
    //$p2 = $percentage-$p1;
    echo "<div class='statistic'>";
    echo "<h4>Time since Feed:</h4>";
    echo "<div class='meter'>";
    echo "<div class='purple-light' id='fill' style='width:$percent%;'></div>";
    echo "<div class='purple' id='fill' style='width:$percent%;'></div></div></div>";

    //fitness
    $percent = ($fitness / 10) * 100; //max display is 10 for now as that is default anything higher only affects weight
    echo "<div class='statistic'>";
    echo "<h4>Fitness:</h4>";
    echo "<div class='meter'>";
    echo "<div class='purple' id='fill' style='width:$percent%;'></div></div></div>";

    //happiness
    $percent = ($happiness / 30) * 100; //30 is max here if happiness stat every changes
    echo "<div class='statistic'>";
    echo "<h4>Happiness:</h4>";
    echo "<div class='meter'>";
    echo "<div class='purple' id='fill' style='width:$percent%;'></div></div></div>";


    echo "<hr>";

    echo "<h3>Food And Drink</h3>";
    echo "<div>";
    echo '<form action="managePet.php" method="post">';
    echo "<input  type='hidden' name='type' value='feed'>";
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<button  class='pink' type='submit' >Feed $pet[name]</button>";
    echo '</form>';
    echo "</div>";

    echo "<hr>";

    echo "<h3>Activities:</h3>";
    echo "<div>";
    echo '<form action="managePet.php" method="post">';
    echo "<input  type='hidden' name='type' value='excercise'>";
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<button  class='pink' type='submit'>Excercise with $pet[name]</button>";
    echo '</form>';
    echo '<form action="managePet.php" method="post">';
    echo "<input  type='hidden' name='type' value='play'>";
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<button  class='pink' type='submit'>Play with $pet[name]</button>";
    echo '</form>';
    echo "</div>";
    echo "</card>";

    echo "<hr>";

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
    echo "<br>";
    echo "</div>";
    echo "</div>";
  }
  pageEnd();
}

?>