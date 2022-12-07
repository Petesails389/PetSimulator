<?php
include "init.php";

$user = getUserId();
$username = getUser();
$pets = getPets();

pageHeader();
pageStart();
echo "<h2>Your Pets:</h2>";
if (count($pets) > 0){
  echo "<div class='cardContainer'>";
  foreach ($pets as $pet){
    $birthday = date("d/m/Y", $pet['birthday']);
    $death = checkForDeath($pet['id']);
    $deathday =  date("d/m/Y", $death[2]);
    $type = getPetType($pet['type']);
    $hunger = round(getHunger($pet['id']),1);
    $weight = getWeight($pet['id']);
    $fitness = round(getFitness($pet['id']),1);
    $happiness = round(getHappiness($pet['id']),1);
    $age = getAge($pet['id']);
    $idealWeight = $type['healthy_weight']/1000;


    if ($pet['dead']==1) {
      echo "<card onclick='togglePetDetails($pet[id])'>";
    } else {
      echo "<card class='purple' onclick='togglePetDetails($pet[id])'>";
    }
    echo "<div class='cardContents'>";
    echo "<div class='petName'>";
    echo "<h3>$pet[name]</h3>";
    echo '<form  action="managePet.php" method="get">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<button  class='cyan' type='submit'>Interact</button>";
    echo '</form>';
    echo "</div>";
    echo "<div class='details' id='$pet[id]'>";
    echo "<h4>Info:</h4>";
    echo "<div>$pet[name] is a $type[name].</div>";
    echo "<div>Their birthday is $birthday. They are $age days old.</div>";
    echo "<div>They should weigh $idealWeight Kg.</div>";
    echo "<br>";
    echo "<h4>Raw Statistics:</h4>";
    echo "<div>Hunger: $hunger hours since last feed.</div>";
    echo "<div>Weight: $weight kg</div>";
    echo "<div>Fitness: $fitness (Arbitrary value - defaults to 10)</div>";
    echo "<div>Happiness: $happiness (Arbitrary value - defaults to 10)</div>";
    if ($pet['dead']) {
      echo "<div>Dead: yes. :( I'm sorry for you're loss.<div> </div>Cause: $pet[cause].<div> </div>Date: $deathday.</div>";
    } else {
      echo "<div>Dead: Nope. :) Good on you! </div>";
    }
    echo "<br>";
    echo "<h4>Actions:</h4>";
    echo "<div class='Actions'>";
    echo '<form  action="renamePet.php" method="get">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo '<button  class="pink" type="submit">Rename</button>';
    echo '</form>';
    echo '<form  action="killPet.php" method="post">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo '<button  class="pink" type="submit" ';
    if ($pet['dead']){
      echo"disabled=''";
    }
    echo ">Kill</button>'";
    echo '</form>';
    echo '<form  action="removePet.php" method="post">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo '<button  class="pink" type="submit">Delete</button>';
    echo '</form>';
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</card>";
    echo "<br>";
  }
  echo "</div>";
}
else{
  echo "<div class='content'>You have no pets!</div>";
}
pageEnd();
$dbh = null;
?>