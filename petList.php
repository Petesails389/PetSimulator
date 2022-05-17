<!doctype html>

<html>
<?php
include "init.php";

$user = getUserId();
$username = getUser();
$pets = getPets();
$dbh = null;

pageHeader();
echo "<body>";
pageStart();
echo "<div>";
echo "<h2>Your Pets:</h2>";
if (count($pets) > 0){
  foreach ($pets as $pet){
    echo "<div class='section'>";
    echo '<form action="managePet.php" method="get">';
    echo "<input type='hidden' name='id' value=$pet[id]>";
    echo "<input type='submit' value='$pet[name]''>";
    echo '</form>';
    echo '<form  action="removePet.php" method="post">';
    echo "<input  type='hidden' name='id' value=$pet[id]>";
    echo '<input  type="submit" value="Delete">';
    echo '</form>';
    echo "</div>";
    echo "<br>";
  }
}
else{
  echo "<div class='content'>You have no pets!</div>";
}
echo "</div>";
pageEnd()
?>
</html>