<?php
  function getHunger($id, $raw = false){
    $lastFeed = getLastActionDate("feed",$id)[0];
    $waitTime = time() - $lastFeed;
    $hunger = $waitTime;
    if ($raw = false){
      $fitnessWeighting = getFitness($id);
      $hunger = $waitTime/$fitnessWeighting;
    }
    return $hunger/60/60;
  }
  function getAge($id) {
    $age = time() - getPet($id)['birthday'];
    return round($age/60/60/24);
  }
  function getAverageActivityTime($id, $type, $days=7, $assumeNow = false){
    $timestamp = time() - (60*60*24*$days);
    $allActivities = getRecentActionDates($type, $id, $timestamp);
    $count = count($allActivities);
    if ($assumeNow) {
       $latest = time();
    } else {
      $count -= 1;
      $latest = $allActivities[$count][0];
    }
    $age = getAge($id);
    if ($age >= 7 ) { 
      $first = $allActivities[0][0];
      $total = $count;
    } else {
      $first = time()-$days*60*60*24;
      $preFeeds = abs(round(($first-getPet($id)['birthday'])/60/60/8));
      $total = $count + $preFeeds;
    }
    $average = ($latest-$first) / $total;
    return abs($average);
  }
  function getWeight($id, $days=7) {
    $feedTime = 8;
    $pet = getPet($id);
    $age = getAge($id);
    $type = getPetType($pet['type']);
    $latest = time()-getLastActionDate("feed",$id)[0];
    if ($feedTime < $latest/60/60){
      $assumeNow = true;
    } else {
      $assumeNow = false;
    }
    $averageFeed = getAverageActivityTime($id, "feed", $days, $assumeNow)/60/60;
    $averageExcercise = getAverageActivityTime($id, "excercise",$days)/60/60;
    $idealWeight = $type['healthy_weight']/1000;
    $weight = (min($averageExcercise,$feedTime)*$idealWeight)/$averageFeed;
    return round($weight,2);
  }
  function getFitness($id, $days=7) {
    $timestamp = time() - (60*60*24*$days);
    $average = getAverageActivityTime($id, "excercise", $days)/60/60;
    $fitness =  10*(8/$average);
    return round($fitness,20);
  }
  function checkForDeath($id) {
    $pet = getPet($id);
    $type = getPetType($pet['type']);
    $hunger = getHunger($id);
    $weight = getWeight($id);
    $age = max(getAge($id),7);
    $totalWeight = getWeight($id,$age);
    $idealWeight = $type['healthy_weight']/1000;;
    $dead = false;
    $cause = NULL;
    
    if ($hunger > 48) {
      $dead = true;
      $cause = "starvation";
    }
    if ($totalWeight >= $idealWeight*3 AND $weight > $idealWeight) {
      $dead = true;
      $cause = "obesity";
    }
    if ($totalWeight <= $idealWeight/3 AND $weight < $idealWeight) {
      $dead = true;
      $cause = "malnuorishment";
    }
    return array($dead,$cause);
  }
?>