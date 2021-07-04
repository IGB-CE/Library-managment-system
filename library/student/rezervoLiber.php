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
if (isset($_GET['rezervo'])) {
    $lib = $_GET['id_lib'];
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `flet_porosi` WHERE id_librit=" . $lib . "  AND id_student=" . $id . "  AND (statusi=1 OR statusi=2 OR statusi =3)";
    $rez = mysqli_query($con, $sql);
    if (mysqli_num_rows($rez) != 0) {
        $info = "Ju keni bere kerkese per kete liber tashme ose libri juaj eshte pranuar ose libri juaj eshte terhequr ose tirazhi esh!";
    } else {
        $dt = $_GET['datater'];
        $dl = $_GET['datalesh'];
        $dk=date("Y-m-d");
        $sql1 = "UPDATE `libri` SET tirazhi=tirazhi-1 WHERE id_librit='$lib';";
        mysqli_query($con, $sql1);
        $status = 1;
        $njoftuar = 0;
        $sql = "INSERT INTO `flet_porosi`(`id_porosi`, `id_librit`, `id_student`, `data_kerkeses`, `data_terheqjes`, `data_rikthimit`, `statusi`,`njoftuar` ) VALUES (NULL,'$lib','$id',CAST('" . $dk . "' AS DATETIME),'$dt','$dl','$status','$njoftuar')";
        $rez = mysqli_query($con, $sql);
    }
}
header('location:kerkesa.php');
?>

