<!DOCTYPE html>
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
<html>
<head>
    <meta charset="utf-8">
    <title>Kategorite</title>
    <link rel="stylesheet" href="../stili.css">
    <script defer src="k.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body>
<?php
include_once '../navbar.php';
?>
<div class="row">
    <div class="column">
        <div class="register-wrapper">
            <div class="register-block">
                <h3 class="register-title">Shtimi i kategorise</h3>
                <p>Plotesoni te dhenat</p>
                <form method="post" action="shtoKategori.php" onsubmit="return a_validim()">
                    <input type="text" id="kategoria" name="kategoria" required>
                    <div class="err" id="kError"></div>
                    <input type="submit" name="submit" value="Regjistro"/>
                </form>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="register-wrapper">
            <?php
            $sql = "SELECT * FROM kategoria_librit";
            $r_query = mysqli_query($con, $sql);
            $src_rez = ' <table class="styled-table" border="1"><thead> 
                 <tr><td>ID Kategori</td>
                 <td>Kategoria</td>
                 <td>Veprime</td></tr>
            </thead>
            <tbody>';
            while ($row = mysqli_fetch_array($r_query)) {
                $src_rez .= '<tr><td>' . $row['id_kategori'] . '</td>';
                $src_rez .= '<td>' . $row['kategoria'] . '</td>';
                $src_rez .= '<td><button class="button" onclick="document.location=\'fshiKategori.php?id=' . $row['id_kategori'] . '\'">FSHI</button></td></tr>';
            }
            echo $src_rez;
            ?>
        </div>
    </div>
</div>
</body>
</html>