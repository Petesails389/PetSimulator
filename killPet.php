<?php
include "init.php";

kill($_POST['id'],"MURDER! YOU EVIL PERSON!", time());
header("location:/");

?>