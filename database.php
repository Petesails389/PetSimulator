<?php
  $dir = 'sqlite:/home/runner/PetSimulator/database.sqlite';
  $dbh  = new PDO($dir) or die("cannot open the database");

  function getPets() {
    global $dbh;
    $user = getUserId();
    $result = $dbh->query("SELECT id, name FROM pets WHERE owner_id = $user");
    return $result->fetchAll();
  }
  function getPetInfo($id) {
    global $dbh;
    $result = $dbh->query("SELECT * FROM pets WHERE id=$id");
    return $result->fetchAll();
  }
  function createPet($name,$type) {
    global $dbh;
    $user = getUserId();
    $date = date("d.m.Y");
    $result = $dbh->query("INSERT INTO pets (owner_id, name, type, birthday) VALUES ($user, '$name','$type','$date')");
    return true; //of course it went in, why wouldn't it?
  }
  function removePet($id){
    global $dbh;
    $owner = $dbh->query("SELECT owner_id FROM pets WHERE id=$id");
    $user = getUserId();
    if ($user == $owner) {
      $result = $dbh->query("DELETE FROM pets WHERE id = $id");
      return true; //again of course it deleted it, why wouldn't it?
    } else {
      return false;
    }
  }
?>