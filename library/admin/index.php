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
?>
<!DOCTYPE html>
<html lang="al">
<head>
    <meta charset="utf-8">
    <title> Index </title>
    <link rel="stylesheet" href="../stili.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body class="bg">
<?php
include_once '../navbar.php';
?>
<div class="register-wrapper">
    <div class="register-block">
    <div style="text-align: center;">
    <h3>Data e sotme : <span id="datetime"></span></h3>
  <script>
   var dt = new Date();
  document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
   </script>
   </div>
        <p class="logo" style="text-align: center; margin-left: 0">Dashboard</p>
        <a href="libri.php">
            <input class="button" type="button" Value="Liber" style="margin-left: 13%"></a>
        <a href="autori.php">
            <input class="button" type="button" value="Autor"></a>
        <a href="kategoria.php">
            <input class="button" type="button" value="Kategori"></a>
    </div>
</div>
        <div class="register-wrapper" style="margin-top: -100px">
            <h3>Lista e librave per t'u terhequr:</h3>
            <?php
            $sql = "SELECT flet_porosi.id_porosi,student.emri, student.mbiemri, student.niveli, student.viti, libri.titulli_librit, libri.botimi, flet_porosi.data_terheqjes, statusi.info FROM flet_porosi INNER JOIN student ON flet_porosi.id_student=student.id INNER JOIN libri ON flet_porosi.id_librit=libri.id_librit INNER JOIN statusi ON flet_porosi.statusi=statusi.id_status WHERE info='Pranuar'  
ORDER BY `flet_porosi`.`data_kerkeses`  DESC";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo 'Nuk ka libra per t\'u terhequr!';
            } else {
                $scr_rez = '<table class="styled-table" border="2px">';
                $scr_rez .= '<thead>';
                $scr_rez .= '<th>KERKESA</th>';
                $scr_rez .= '<th>EMRI</th>';
                $scr_rez .= ' <th>MBIEMRI</th>';
                $scr_rez .= '<th>LIBRI</th>';
                $scr_rez .= '<th>BOTIMI</th>';
                $scr_rez .= '<th bgcolor="red">DATA TERHEQJES</th>';
                $scr_rez .= '<th>Veprime</th>';
                $scr_rez .= ' </thead>';
                $scr_rez .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $scr_rez .= "<tr>";
                    $scr_rez .= "<td>" . $row['id_porosi'] . "</td>";
                    $scr_rez .= "<td>" . $row['emri'] . "</td>";
                    $scr_rez .= "<td>" . $row['mbiemri'] . "</td>";
                    $scr_rez .= "<td>" . $row['titulli_librit'] . "</td>";
                    $scr_rez .= "<td>" . $row['botimi'] . "</td>";
                    $scr_rez .= "<td bgcolor='red'>" . $row['data_terheqjes'] . "</td>";
                    $scr_rez .= '<td><button class="button" onclick="document.location=\'validoKerkese.php?id=' . $row['id_porosi'] . '&mode=t\'">Terheqje</button><button class="button" onclick="document.location=\'validoKerkese.php?id=' . $row['id_porosi'] . '&mode=r\'">Anullim</button></td>';
                    $scr_rez .= "</tr>";
                }
                $scr_rez .= '</tbody>';
                $scr_rez .= '</table>';
                echo $scr_rez;
            }
            ?>
    </div>
        <div class="register-wrapper" style="margin-top: -100px">
            <h3>Lista e librave per t'u kthyer:</h3>
            <?php
            $sql = "SELECT flet_porosi.id_porosi,student.emri, student.mbiemri, student.niveli, student.viti, libri.titulli_librit, libri.botimi, flet_porosi.data_kerkeses,flet_porosi.data_terheqjes,flet_porosi.data_rikthimit, statusi.info, flet_porosi.njoftuar FROM flet_porosi INNER JOIN student ON flet_porosi.id_student=student.id INNER JOIN libri ON flet_porosi.id_librit=libri.id_librit INNER JOIN statusi ON flet_porosi.statusi=statusi.id_status WHERE info='Terhequr'  
ORDER BY `flet_porosi`.`data_kerkeses`  DESC";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo 'Nuk ka libra per t\'u kthyer!';
            } else {
                $src_rez = '<table class="styled-table" border="2px"><thead>';
                $src_rez .= '<th>KERKESA</th>';
                $src_rez .= '<th>EMRI</th>';
                $src_rez .= '<th>MBIEMRI</th>';
                $src_rez .= '<th>LIBRI</th>';
                $src_rez .= '<th>BOTIMI</th>';
                $src_rez .= '<th>DATA TERHEQJES</th>';
                $src_rez .= '<th bgcolor="red">DATA PLANIFIKUAR PER KTHIM</th>';
                $src_rez .= '<th>VEPRIME</th></thead><tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $src_rez .= '<tr>';
                    $src_rez .= "<td>" . $row['id_porosi'] . "</td>";
                    $src_rez .= "<td>" . $row['emri'] . "</td>";
                    $src_rez .= "<td>" . $row['mbiemri'] . "</td>";
                    $src_rez .= "<td>" . $row['titulli_librit'] . "</td>";
                    $src_rez .= "<td>" . $row['botimi'] . "</td>";
                    $src_rez .= "<td>" . $row['data_terheqjes'] . "</td>";
                    $src_rez .= "<td bgcolor='red'>" . $row['data_rikthimit'] . "</td>";
                    $src_rez .= '<td><button class="button" onclick="document.location=\'kthimLibri.php?id=' . $row['id_porosi'] . '\'">KTHYER</button>';
                    if (!$row['njoftuar'])
                        $src_rez .= '<button class="button" onclick="document.location=\'njoftoSkadence.php?id=' . $row['id_porosi'] . '\'">NJOFTO</button></td>';
                        else{
                            $src_rez.='<i style="color:white;"">Studenti eshte njoftuar</i>';
                        }
                    $src_rez .= "</tr>";
                }
                $src_rez .= "</body></table>";
                echo $src_rez;
            }
            ?>
        </div>
<div class="sticky">
    <?php
    if (isset($_GET['info'])) {
        echo $_GET['info'];
        unset($_GET['info']);
    }
    else if (isset($_SESSION['tip'])){
        echo $_SESSION['tip'];
        unset($_SESSION['tip']);
    }
    ?>
</div>
<?php
include_once '../footer.php';
?>
</body>
</html>