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
$sql = "SELECT * FROM autori_librit";
session_start();
$r_query = mysqli_query($con, $sql);
$src_rez = ' <table border="1"><thead> 
                 <tr><td>Id Autor</td>
                 <td>Autori</td>
                 <td>Veprime</td></tr>
            </thead>
            <tbody>';

while ($row = mysqli_fetch_array($r_query)) {
    $src_rez .= '<tr><td>' . $row['id_autor'] . '</td>';
    $src_rez .= '<td>' . $row['autori'] . '</td>';
    $src_rez .= '<td><button onclick="document.location=\'php/fshiAutor.php?id=' . $row['id_autor'] . '\'">FSHI</button></td></tr>';
}
$_SESSION['rez'] = $src_rez;
?>
<script>
    window.history.back();
</script>
