<?php
require_once '../lidhja.inc.php';
session_start();
if (!isset($_SESSION["roli"])) {
    header("location:../index.php");
}
else{
    if ($_SESSION["roli"]=='admin'){
        header("location:../admin/index.php");
    }
}
if (isset($_GET['id'])) {
    $p = 5;
    $id = $_GET['id'];
    $sql1="SELECT `id_librit` FROM `flet_porosi` WHERE id_porosi='$id'";
    $result= mysqli_query($con, $sql1);
    $row=mysqli_fetch_assoc($result);
    $id_lib=$row['id_librit'];
    $sql = "UPDATE `flet_porosi` SET `statusi`='$p' WHERE id_porosi='$id';";
    mysqli_query($con, $sql);
    $sql2 = "UPDATE `libri` SET tirazhi=tirazhi+1 WHERE id_librit='$id_lib';";
    mysqli_query($con, $sql2);

}
else{
    echo 'KUJDES';
}
?>
<script>
    window.history.back();
</script>