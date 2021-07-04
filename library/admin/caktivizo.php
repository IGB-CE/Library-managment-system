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
    if ($_GET['mode'] == 'c'){
    $p=0;
        $sql1 = "UPDATE `student` SET `aktivizuar`='$p' WHERE id='$id'";
        mysqli_query($con, $sql1);
    }
    else{
        $p=1;
        $sql1 = "UPDATE `student` SET `aktivizuar`='$p' WHERE id='$id'";
        mysqli_query($con, $sql1);
    }
}

?>
<script>
    window.history.back();
</script>