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
echo "<h2>Manage your pets:</h2>";
if (count($pets) > 0){
  foreach ($pets as $pet){
    echo "$pet[name]";
    echo '<form action="removePet.php" method="post">';
    echo "<input type='hidden' name='id' value=$pet[id]>";
    echo '<input type="submit" value="delete">';
    echo '</form>';
  }
}
else{
  echo "You have no pets!";
}
echo "</div>";
?>
</html>