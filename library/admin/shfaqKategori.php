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
$sql = "SELECT * FROM kategoria_librit";
$r_query = mysqli_query($con, $sql);
$src_rez = ' <table border="1"><thead> 
                 <tr><td>ID Kategori</td>
                 <td>Kategoria</td>
                 <td>Veprime</td></tr>
            </thead>
            <tbody>';
while ($row = mysqli_fetch_array($r_query)) {
    $src_rez .= '<tr><td>' . $row['id_kategori'] . '</td>';
    $src_rez .= '<td>' . $row['kategoria'] . '</td>';
    $src_rez .= '<td><button onclick="document.location=\'php/fshiKategori.php?id=' . $row['id_kategori'] . '\'">FSHI</button></td></tr>';
}
$_SESSION['rez'] = $src_rez;
?>
<script>
    window.history.back();
</script>