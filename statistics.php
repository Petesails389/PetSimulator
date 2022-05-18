<?php
  function getHunger($id){
    $lastFeed = getLastActionDate("feed",$id)[0];
    $waitTime = time() - $lastFeed;
    return round($waitTime/60/60);
  }
?>