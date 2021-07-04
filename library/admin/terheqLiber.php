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
    $p = 3;
    $id = $_GET['id'];
    $sql = "SELECT * FROM flet_porosi WHERE id_porosi=$id";
    echo $sql;
    $rez = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($rez);
    $ter = date("Y-m-d");
    $llog = $row['periudha_mbajtjes']*7;
    $kth = date("Y-m-d", strtotime("$ter+$llog day"));
    echo $kth;
    $sql = "UPDATE `flet_porosi` SET `data_terheqjes`='$ter',`data_rikthimit`='$kth',`statusi`='$p'  WHERE id_porosi='$id';";
    mysqli_query($con, $sql);
    $txt = "U perditesua me sukses!";
} else
    $txt = "Nuk u perditesua!";
$_SESSION['tip'] = $txt;
?>
<script>
    window.history.back();
</script>