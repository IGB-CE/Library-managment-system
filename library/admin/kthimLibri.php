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
    $p = 4;
    $id = $_GET['id'];
   
    $sql1="SELECT `id_librit` FROM `flet_porosi` WHERE id_porosi='$id'";
    $result= mysqli_query($con, $sql1);
    $row=mysqli_fetch_assoc($result);
    $id_lib=$row['id_librit'];
   
    $sql = "UPDATE `flet_porosi` SET `statusi`='$p' WHERE id_porosi='$id';";
    mysqli_query($con, $sql);
    $sql1 = "UPDATE `libri` SET tirazhi=tirazhi+1 WHERE id_librit='$id_lib';";
    mysqli_query($con, $sql1);

}
else{
    echo 'KUJDES';
}
?>
<script>
    window.history.back();
</script>