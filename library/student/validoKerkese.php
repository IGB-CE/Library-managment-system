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
    if ($_GET['mode'] == 'a')
        $p = 5;
    $id = $_GET['id'];
    $sql = "UPDATE `flet_porosi` SET `statusi`='$p' WHERE id_porosi='$id';";
    mysqli_query($con, $sql);
}
?>
<script>
    window.history.back();
</script>