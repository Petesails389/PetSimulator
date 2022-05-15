<!doctype html>
<?php
$dir = 'sqlite:/home/runner/PetSimulator/database.sqlite';
$dbh  = new PDO($dir) or die("cannot open the database");

$username = "Bob";
$pets = $dbh->query("SELECT id, name FROM pets WHERE owner = '$username'");

$dbh = null;

?>
<html>
  <head>
    <title>Pet Simulator</title>
  </head>
  <body>
    <?php 

echo "<h1>Hello, $username! Welcome to Pet Simulator!</h1>";
echo "<h2>Your Pets:</h2>";
echo "<div>";
foreach ($pets as $pet){
  echo "$pet[name]";
  echo '<form action="removePet.php" method="post">';
  echo "<input type='hidden' name='id' value=$pet[id]>";
  echo '<input type="submit" value="delete">';
  echo '</form>';
  echo "<br>";
}
echo "</div>";

    ?>
  </body>
</html>