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
    $type = getPetType($pet['type']);
    $hunger = getHunger($pet['id']);
    
    echo "<div class='box'>";
    echo "<div class='flex'>";
    echo "<h3>$pet[name]</h3>";
    echo "<button id='lable$pet[id]' class='noBox' type='button' onclick='togglePetDetails($pet[id])'>show more</button>";
    echo '</form>';
    echo '<form  action="managePet.php" method="get">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo "<input  type='submit' value='Interact'>";
    echo '</form>';
    echo "</div>";
    echo "<div class='details' id='$pet[id]'>";
    echo "<h4>Info:</h4>";
    echo "<div>$pet[name] is a $type.</div>";
    echo "<div>$pet[name]'s birthday is $birthday.</div>";
    echo "<br>";
    echo "<h4>Statistics:</h4>";
    echo "<div>Hunger: $hunger</div>";
    echo "<br>";
    echo "<h4>Actions:</h4>";
    echo "<div class='flex'>";
    echo '<form  action="renamePet.php" method="get">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo '<input  type="submit" value="Rename">';
    echo '</form>';
    echo '<form  action="removePet.php" method="post">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo '<input  class="danger" type="submit" value="Delete">';
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