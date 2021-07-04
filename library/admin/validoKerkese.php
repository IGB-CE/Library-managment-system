<?php
require_once '../lidhja.inc.php';
session_start();
if (!isset($_SESSION["roli"])) {
    header("location:../index.php");
}
else{
    if ($_SESSION["roli"]=='student'){
        header("location:../student/index.php");
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql1="SELECT `id_librit` FROM `flet_porosi` WHERE id_porosi='$id'";
    $result= mysqli_query($con, $sql1);
    $row=mysqli_fetch_assoc($result);
    $id_lib=$row['id_librit'];
    if ($_GET['mode'] == 'r'){
        $p = 6;
        $sql1 = "UPDATE `libri` SET tirazhi=tirazhi+1  WHERE id_librit='$id_lib';";
        mysqli_query($con, $sql1);
    }

    else if($_GET['mode'] == 'p'){
    $p = 2;
    }
    else if($_GET['mode'] == 't')
    {
        $p=3;
    }
    $id = $_GET['id'];
    $sql = "UPDATE `flet_porosi` SET `statusi`='$p' WHERE id_porosi='$id';";
    mysqli_query($con, $sql);
}
?>
<script>
    window.history.back();
</script>