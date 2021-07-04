<!DOCTYPE html>
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
?>
<html>
<head>
    <meta charset="utf-8">
    <title> Kerkesa </title>
    <link rel="stylesheet" href="../stili.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body>
<?php
include_once '../navbar.php';
?>
<div class="register-wrapper">
    <h2>Date e sotme: <span id="datetime"></span></h2>

    <script>
        var dt = new Date();
        document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
    </script>
    <h3>Lista e librave te kerkuar:</h3>
    <?php
    $id = $_SESSION['id'];
    $sql = "SELECT libri.titulli_librit,libri.botimi,statusi.info,flet_porosi.id_porosi,flet_porosi.data_terheqjes,flet_porosi.data_rikthimit FROM student INNER JOIN flet_porosi ON student.id=flet_porosi.id_student INNER JOIN libri ON flet_porosi.id_librit=libri.id_librit INNER JOIN statusi ON flet_porosi.statusi=statusi.id_status WHERE id_student='$id' AND info='Kerkuar'";
    $r_query = mysqli_query($con, $sql);
    if (mysqli_num_rows($r_query) == 0) {
        echo 'Nuk ka libra te kerkuar!';
    } else {
        echo 'Ju keni te drejte te anuloni kerkesen per rezervimin e librave deri ne momentin qe ajo eshte pranuar nga administratori.';
        $src_rez = ' <table class="styled-table" border="1"><thead> 
                 <tr><th>Libri</th>
                 <th>Botimi</th>
                 <th bgcolor="red">Data Terheqjes</th>
                 <th bgcolor="red">Data Leshimit</th>
                 <th>Statusi</th>
                 <th>ANULLO</th>
                 </tr>
                 
            </thead>
            <tbody>';
        while ($row = mysqli_fetch_array($r_query)) {
            $src_rez .= '<tr><td>' . $row['titulli_librit'] . '</td>';
            $src_rez .= '<td>' . $row['botimi'] . '</td>';
            $src_rez .= '<td>' . $row['data_terheqjes'] . '</td>';
            $src_rez .= '<td>' . $row['data_rikthimit'] . '</td>';
            $src_rez .= '<td>' . $row['info'] . '</td>';
            $src_rez .= '<td><button class="button" onclick="document.location=\'anulloKerkese.php?id=' . $row['id_porosi'] . '\'">ANULLO</button></td></tr>';
        }
        $src_rez .= '</tbody></table>';

        echo $src_rez;
    }
    ?>
</div>
<form method="get" action="anulloKerkese.php">
    <input type="hidden" name="id_lib" value=".<?php echo $id; ?>.">
    <form>
        <div class="register-wrapper" style="margin-top: -100px">
            <h3>Lista e librave te pranuar:</h3>
            <?php
            $id = $_SESSION['id'];

            $sql = "SELECT libri.titulli_librit,libri.botimi,statusi.info,flet_porosi.data_terheqjes,flet_porosi.data_rikthimit FROM student INNER JOIN flet_porosi ON student.id=flet_porosi.id_student INNER JOIN libri ON flet_porosi.id_librit=libri.id_librit INNER JOIN statusi ON flet_porosi.statusi=statusi.id_status WHERE id_student='$id' AND info='Pranuar'";
            $r_query = mysqli_query($con, $sql);
            if (mysqli_num_rows($r_query) == 0) {
                echo 'Nuk ka libra te pranuar!';
            } else {
                echo "Ne rast te mos paraqitjes ne daten e caktuar te terheqjes, administratori ka te drejte te refuzoj kerkesen tuaj.";
                $src_rez = ' <table class="styled-table" border="1"><thead> 
                 <tr><th>Libri</th>
                 <th>Botimi</th>
                 <th bgcolor="red">Data Terheqjes</th>
                 <th>Data Leshimit</th>
                 <th>Statusi</th></tr>
            </thead>
            <tbody>';
                while ($row = mysqli_fetch_array($r_query)) {
                    $src_rez .= '<tr><td>' . $row['titulli_librit'] . '</td>';
                    $src_rez .= '<td>' . $row['botimi'] . '</td>';
                    $src_rez .= '<td bgcolor="red">' . $row['data_terheqjes'] . '</td>';
                    $src_rez .= '<td>' . $row['data_rikthimit'] . '</td>';
                    $src_rez .= '<td>' . $row['info'] . '</td></tr>';
                }
                $src_rez .= "</tbody></table>";
                echo $src_rez;
            }
            ?>
        </div>
        <div class="register-wrapper" style="margin-top: -100px">
            <h3>Lisat e librave te terhequr:</h3>
            <?php
            $id = $_SESSION['id'];
            $sql = "SELECT libri.titulli_librit,libri.botimi,statusi.info,flet_porosi.data_terheqjes,flet_porosi.data_rikthimit FROM student INNER JOIN flet_porosi ON student.id=flet_porosi.id_student INNER JOIN libri ON flet_porosi.id_librit=libri.id_librit INNER JOIN statusi ON flet_porosi.statusi=statusi.id_status WHERE id_student='$id' AND info='Terhequr'";
            $r_query = mysqli_query($con, $sql);
            if (mysqli_num_rows($r_query) == 0) {
                echo 'Nuk ka libra per te terhequr!';
            } else {
                echo "Ne rast te mos paraqitjes ne daten e caktuar te leshimit, administratori ka te drejte t'ju caktivizoje nga libraria per moszbatim te rregullores!";
                $src_rez = ' <table class="styled-table" border="1"><thead> 
                 <tr><th>Libri</th>
                 <th>Botimi</th>
                 <th>Data Terheqjes</th>
                 <th bgcolor="red">Data Leshimit</th>
                 <th>Statusi</th></tr>
            </thead>
            <tbody>';
                while ($row = mysqli_fetch_array($r_query)) {
                    $src_rez .= '<tr><td>' . $row['titulli_librit'] . '</td>';
                    $src_rez .= '<td>' . $row['botimi'] . '</td>';
                    $src_rez .= '<td>' . $row['data_terheqjes'] . '</td>';
                    $src_rez .= '<td bgcolor="red">' . $row['data_rikthimit'] . '</td>';

                    $src_rez .= '<td>' . $row['info'] . '</td></tr>';
                }
                $src_rez .= "</tbody></table>";
                echo $src_rez;
            }
            ?>
            <p>
            <div class="bllok-map">
                <h3>Per terheqjen dhe kthimin e librave ju lutemi te paraqiteni ne adesen e meposhtme nga e hena ne te
                    premten ne orarin <b>08:00-14:00</b> :</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11986.586169491275!2d19.8216134!3d41.3165523!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdf5dc3ad387e1db5!2sFTI%20-%20Fakulteti%20Teknologjis%C3%AB%20s%C3%AB%20Informacionit!5e0!3m2!1sen!2s!4v1614010080991!5m2!1sen!2s"
                        width="900" height="300" style="border:2;" allowfullscreen="" loading="lazy"></iframe>
                <h4><b> <i>
                            KUJDES! PERSONAT QE NUK ZBATOJNE MASAT ANTI COVID NUK LEJOHEN TE FREKUENTOJNE AMBIENTET E
                            BIBLIOTEKES!</i></b></h4>
            </div>
            </p>

        </div>
        <?php
        include_once '../footer.php';
        ?>
</body>
</html>