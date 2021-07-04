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
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM `libri` WHERE id_librit = '" . $id . "'";
    mysqli_query($con, $sql);
}
?>
<script>
    window.history.back();
</script>