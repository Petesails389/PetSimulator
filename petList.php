<?php
include "init.php";

$user = getUserId();
$username = getUser();
$pets = getPets();

pageHeader();
pageStart();
echo "<div>";
echo "<h2>Your Pets:</h2>";
if (count($pets) > 0){
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
      echo "<div class='boxRed'>";
    } else {
      echo "<div class='box'>";
    }
    echo "<div class='flex'>";
    echo "<h3>$pet[name]</h3>";
    echo '</form>';
    echo '<form  action="managePet.php" method="get">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<input  type='submit' value='Interact'>";
    echo '</form>';
    echo "<div class='spacer'></div>";
    echo "<button id='lable$pet[id]' class='noBox' type='button' onclick='togglePetDetails($pet[id])'>show more</button>";
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
      echo "<div>Dead: True.<div> </div>Cause: $pet[cause].<div> </div>CDate: $deathday.</div>";
    } else {
      echo "<div>Dead: False. </div>";
    }
    echo "<br>";
    echo "<h4>Actions:</h4>";
    echo "<div class='flex'>";
    echo '<form  action="renamePet.php" method="get">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo '<input  type="submit" value="Rename">';
    echo '</form>';
    echo '<form  action="removePet.php" method="post">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo '<input  class="red" type="submit" value="Delete">';
    echo '</form>';
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "<br>";
  }
}
else{
  echo "<div class='content'>You have no pets!</div>";
}
echo "</div>";
pageEnd();
$dbh = null;
?>