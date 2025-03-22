<?php 
require_once ('../../../config.php');
include("../Auth.php");
session_start();

$auth = new Auth($conn);
$auth->logout();

?>

