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
    $porosi = $_GET['id'];
    $sql = "SELECT flet_porosi.data_rikthimit, libri.titulli_librit, student.emri, student.email FROM `flet_porosi` INNER JOIN libri INNER JOIN kategoria_librit ON libri.id_kategori=kategoria_librit.id_kategori ON flet_porosi.id_librit=libri.id_librit
 INNER JOIN student ON flet_porosi.id_student=student.id WHERE id_porosi=$porosi";
    $rez = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($rez);
    $d1 = date_create(date("Y-m-d"));
    $d2 = date_create($row['data_rikthimit']);
    $dif = date_diff($d1, $d2);
    $d = $dif->format("%a");
    $emri = $row['emri'];
    $libri = $row['titulli_librit'];
    $subject = "Afati i dorezimit te librit";
    $content = "Pershendetje,\nKy email ju njofton se afati per dorezimin e librit '$libri' eshte ne $d dite.";
    $content .= "\nJu lutem respektoni politikat e bibliotekes dhe permbajuni ketij afati.";
    $from = "From: ftibiblioteka@gmail.com";
    if (mail($row['email'], $subject, $content, $from)) {
        $info = "Emali u dergua me sukses drejt $emri.";
        $query = "UPDATE `flet_porosi` SET `njoftuar`=1 WHERE `id_porosi`=$porosi";
        mysqli_query($con, $query);
    }
} ?>
<script>
    window.history.back();
</script>