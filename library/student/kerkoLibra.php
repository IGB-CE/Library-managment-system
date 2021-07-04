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
$src = mysqli_real_escape_string($con, $_GET['src']);
if (isset($_GET['aut']))
    $aut = mysqli_real_escape_string($con, $_GET['aut']);
if (isset($_GET['kat']))
    $kat = mysqli_real_escape_string($con, $_GET['kat']);

$query = "SELECT * FROM libri INNER JOIN autori_librit ON id_autorit=autori_librit.id_autor INNER JOIN kategoria_librit ON libri.id_kategori=kategoria_librit.id_kategori
WHERE titulli_librit LIKE '%" . $src . "%'";

if (isset($aut))
    $query .= " AND autori = '$aut'";

if (isset($kat))
    $query .= " AND kategoria = '$kat'";
$qry_result = mysqli_query($con, $query);
if (mysqli_num_rows($qry_result) == 0) {
    echo '<h3>Nuk u gjet asnje liber me keto te dhena!</h3>';
} else {
    while ($row = mysqli_fetch_array($qry_result)) {
        $k = $row['kopertina'];
        if ($k == '') {
            $k = "default_book_cover.jpg";
        }
        $src_rez = '<div  style="cursor: pointer" class="book read" onclick="document.location=\'libri.php?id=' . $row['id_librit'] . '\'">';
        $src_rez .= '<div class="cover">';
        $src_rez .= "<img src='../upload/" . $k . "'>";
        $src_rez .= '</div>';
        $src_rez .= '<div class="description">';
        $src_rez .= '<p class="title">' . $row['titulli_librit'] . '</br>';
        $src_rez .= '<span class="author">' . $row['autori'] . '</span></p>';
        $src_rez .= '</div>';
        $src_rez .= '</div>';
        echo $src_rez;
    }
}