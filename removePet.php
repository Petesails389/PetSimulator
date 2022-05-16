<?php
include "init.php";

removePet($_POST['id']);
header("location:/");

?>