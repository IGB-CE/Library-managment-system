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
<html>
<head>
    <meta charset="utf-8">
    <title> Index </title>
    <link rel="stylesheet" href="../stili.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body>
<?php
include_once '../navbar.php';
    ?>
    <div class="register-wrapper">
    <h3>Data e sotme : <span id="datetime"></span></h3>

  <script>
   var dt = new Date();
  document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
   </script>
        <?php
        $sql = "SELECT * FROM flet_porosi INNER JOIN student ON student.id=flet_porosi.id_student INNER JOIN libri ON flet_porosi.id_librit=libri.id_librit INNER JOIN statusi ON flet_porosi.statusi=statusi.id_status INNER JOIN autori_librit ON libri.id_autorit=autori_librit.id_autor WHERE info='Kerkuar'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result)==0) {
            echo '<h3>Nuk ka kerkesa te reja!</h3>';
        }
        else {
            $src_rez = ' <table class="styled-table" border="1"><thead> 
                 <tr>
                 <th>Id Porosi</th>
                 <th>Emri</th>
                 <th>Mbiemri</th>
                 <th>Niveli</th>
                 <th>Viti</th>
                 <th>Titulli</th>
                 <th>Botimi</th>
                 <th>Autori</th>
                 <th>Data Terheqjes</th>
                 <th>Data Rikthimit</th>
                 <th>Veprime</th>
                 </tr>
            </thead>
            <tbody>';
            while ($row = mysqli_fetch_array($result)) {
                $src_rez .= '<tr><td>' . $row['id_porosi'] . '</td>';
                $src_rez .= '<td>' . $row['emri'] . '</td>';
                $src_rez .= '<td>' . $row['mbiemri'] . '</td>';
                $src_rez .= '<td>' . $row['niveli'] . '</td>';
                $src_rez .= '<td>' . $row['viti'] . '</td>';
                $src_rez .= '<td>' . $row['titulli_librit'] . '</td>';
                $src_rez .= '<td>' . $row['botimi'] . '</td>';
                $src_rez .= '<td>' . $row['autori'] . '</td>';
                $src_rez .= '<td>' . $row['data_terheqjes'] . '</td>';
                $src_rez .= '<td>' . $row['data_rikthimit'] . '</td>';

                $src_rez .= '<td><button class="button" onclick="document.location=\'validoKerkese.php?id=' . $row['id_porosi'] . '&mode=r\'">Refuzo</button>';
                $src_rez .= '<button class="button" onclick="document.location=\'validoKerkese.php?id=' . $row['id_porosi'] . '&mode=p\'">Prano</button></td></tr>';
            }
            echo $src_rez;
        }
        ?>
    </div>
</body>
</html>