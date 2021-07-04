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
if (isset($_POST['submit'])) {
    $count = 0;
    $sql = 'SELECT autori from `autori_librit`';
    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['autori'] == $_POST['autori']) {
            $count = $count + 1;
        }
    }
    $autori = mysqli_real_escape_string($con, $_POST['autori']);
    if ($count == 0) {
        $sqli = "INSERT INTO `autori_librit`(`id_autor`, `autori`) VALUES ( NULL ,'$autori')";
        mysqli_query($con,$sqli );
    }
}
?>
<script>
    window.history.back();
</script>