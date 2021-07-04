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
    if ($_GET['mode'] == 'h') {
        $sql = "UPDATE `libri` SET tirazhi=tirazhi-1 WHERE id_librit='$id' AND tirazhi>0;";
        mysqli_query($con, $sql);
        $message = "U zvogelua tirazhi i librit me 1 me sukses";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($_GET['mode'] == 'sh') {
        $sql = "UPDATE `libri` SET tirazhi=tirazhi+1 WHERE id_librit='$id';";
        mysqli_query($con, $sql);
        $message = "U shtua tirazhi i librit me 1 me sukses";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>
<script>
    window.history.back();
</script>