<?php
  $dir = 'sqlite:/home/runner/PetSim/database.sqlite';
  $dbh  = new PDO($dir) or die("cannot open the database");

  function getPets() {
    global $dbh;
    $user = getUserId();
    $result = $dbh->query("SELECT * FROM pets WHERE owner_id = $user");
    return $result->fetchAll();
  }
  function getAllPets() {
    global $dbh;
    $result = $dbh->query("SELECT * FROM pets");
    return $result->fetchAll();
  }
  function getPet($id) {
    global $dbh;
    $result = $dbh->query("SELECT * FROM pets WHERE id=$id");
    return $result->fetch();
  }
  function createPet($name,$type) {
    global $dbh;
    $user = getUserId();
    $date = time();
    $result = $dbh->query("INSERT INTO pets (owner_id, name, type, birthday) VALUES ($user, '$name','$type','$date')");
    $petId = $dbh->query("SELECT MAX(id) FROM pets")->fetch()[0];
    return $petId; //of course it went in, why wouldn't it?
  }
  function renamePet($id,$name) {
    global $dbh;
    $owner = $dbh->query("SELECT owner_id FROM pets WHERE id=$id");
    $user = getUserId();
    if ($user == $owner) {
      $result = $dbh->query("UPDATE pets SET name='$name' WHERE id=$id;");
      return true; //again of course it updated the table, why wouldn't it?
    } else {
      return false;
    }
  }
  function removePet($id){
    global $dbh;
    $owner = $dbh->query("SELECT owner_id FROM pets WHERE id=$id");
    $user = getUserId();
    if ($user == $owner) {
      $result = $dbh->query("DELETE FROM pets WHERE id = $id");
      $result = $dbh->query("DELETE FROM actions WHERE pet_id = $id");
      return true; //again of course it deleted it, why wouldn't it?
    } else {
      return false;
    }
  }
  function addAction($type,$id, $offset=0){
    global $dbh;
    $offset = $offset*60*60;
    $owner = $dbh->query("SELECT owner_id FROM pets WHERE id=$id");
    $user = getUserId();
    if ($user == $owner) {
      $dateTime = time() + $offset;
      $result = $dbh->query("INSERT INTO actions (pet_id, action_type, date_time) VALUES ($id, '$type', '$dateTime')");
      return true; //as always it worked
    } else {
      return false;
    }
  }
  function getActions($type,$id) {
    global $dbh;
    $result = $dbh->query("SELECT * FROM actions WHERE pet_id=$id AND action_type='$type'");
    return $result->fetchAll();
  }
  function getRecentActionDates($type,$id,$timestamp) {
    global $dbh;
    $result = $dbh->query("SELECT date_time FROM actions WHERE pet_id=$id AND action_type='$type' AND date_time > $timestamp");
    return $result->fetchAll();
  }
  function getAllActions() {
    global $dbh;
    $result = $dbh->query("SELECT * FROM actions");
    return $result->fetchAll();
  }
  function getLastActionDate($type,$id) {
    global $dbh;
    $result = $dbh->query("SELECT MAX(date_time) FROM actions WHERE pet_id=$id AND action_type='$type'");
    return $result->fetch();
  }
  function getPetType($id) {
    global $dbh;
    $result = $dbh->query("SELECT * FROM petTypes WHERE id=$id");
    return $result->fetch();
  }
  function getAllPetTypes() {
    global $dbh;
    $result = $dbh->query("SELECT * FROM petTypes");
    return $result->fetchAll();
  }
function kill($id,$cause,$date){
  global $dbh;
  $result = $dbh->query("UPDATE pets SET dead=1, cause='$cause', death_date=$date WHERE id=$id;");
  return true;
}
?>