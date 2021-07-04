<?php
include_once 'lidhja.inc.php';
session_start();
session_destroy();
mysqli_close($con);
header("location:index.php");
?>