<?php 

include("../Auth.php");
session_start();

$auth = new Auth;
$auth->logout();

?>

