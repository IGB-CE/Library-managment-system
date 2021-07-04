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
    <title> Regjistrim libri</title>
    <link rel="stylesheet" href="../stili.css">
    <script defer  src="../js/lb.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body onload="document.regjistrimLibri.titulli_librit.focus();">
<?php
include_once '../navbar.php';
?>
<div class="register-wrapper">
    <div class="register-block">
        <h3 class="register-title">Regjistrimi i nje libri te ri</h3>
        <p>Plotesoni te dhenat</p>
        <form method="post" action="shtoLiber.php" enctype="multipart/form-data" onsubmit="return checkInput()">
            <input type="number" name="isbn" id="isbn" placeholder="ISBN" required>
            <div class="err" id="isbnError"></div>
            <input type="text" placeholder="Vendosni Titullin" id="titulli" name="titulli" required/>
            <div class="err" id="titError"></div>
            <textarea rows="10" cols="30" placeholder="Pershkrimi" name="pershkrimi" required></textarea>
            <input type="text" name="botimi" placeholder="Botimi" required>
            <input type="text" name="publikuesi" placeholder="Vendosni publikuesin" required>
            <div class="err" id="pubError"></div>
            <input type="number" min="1900" max="3000" value="2021" name="viti" placeholder="Viti Copyright"
                   required>
            <input type="number" name="nr_faqeve" placeholder="Numri Faqeve" required>
            <input type="number" name="tirazhi" placeholder="Tirazhi" required>
            <label> Zgjidhni autorin:
                <select name="autori">
                    <?php
                    $zgjidh = 'SELECT autori FROM autori_librit';
                    $result = mysqli_query($con, $zgjidh);
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<option>" . $row['autori'] . "</option>";
                    }
                    ?>
                </select>
            </label>
            <label> Zgjidhni kategorine:
                <select name="kategoria">
                    <?php
                    $zgjidh = 'SELECT kategoria FROM kategoria_librit';
                    $result = mysqli_query($con, $zgjidh);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option>" . $row['kategoria'] . "</option>";
                    }
                    ?>
                </select>
            </label>
            <label for="fileSelect">Kopertina:</label>
            <input style="margin-top: 0;" type="file" name="photo" id="fileSelect" required>
            <p><strong>Kujdes:</strong> Lejohen vtm formatet .jpg, .jpeg, .gif, .png deri ne 5MB.</p>
            <input type="submit" name="submit" value="Regjistro"/>
        </form>
    </div>
</div>
<div class="register-wrapper">
    <?php
    $sql = "SELECT libri.id_librit, libri.isbn,libri.titulli_librit,libri.botimi, libri.publikuesi,libri.viti_copyright, libri.nr_faqeve, libri.tirazhi, autori_librit.autori, kategoria_librit.kategoria FROM libri INNER JOIN autori_librit ON libri.id_autorit=autori_librit.id_autor INNER JOIN kategoria_librit ON libri.id_kategori=kategoria_librit.id_kategori";
    $r_query = mysqli_query($con, $sql);
    $src_rez = ' <table class="styled-table" border="2px"><thead> 
                 <tr><td>Seria</td>
                 <td>ISBN</td>
                 <td>Titulli</td>
                 <td>Botimi</td>
                 <td>Publikuesi</td>
                 <td>Copyright</td>
                 <td>Nr_faqeve</td>
                 <td>Tirazhi</td>
                 <td>Autori</td>
                 <td>Kategori</td>
                 <td>Veprime</td></tr>
            </thead>
            <tbody>';
    while ($row = mysqli_fetch_array($r_query)) {
        $src_rez .= '<tr><td>' . $row['id_librit'] . '</td>';
        $src_rez .= '<td>' . $row['isbn'] . '</td>';
        $src_rez .= '<td>' . $row['titulli_librit'] . '</td>';
        $src_rez .= '<td>' . $row['botimi'] . '</td>';
        $src_rez .= '<td>' . $row['publikuesi'] . '</td>';
        $src_rez .= '<td>' . $row['viti_copyright'] . '</td>';
        $src_rez .= '<td>' . $row['nr_faqeve'] . '</td>';
        $src_rez .= '<td>' . $row['tirazhi'] . '     <button class="button" onclick="document.location=\'ndryshoTirazhin.php?id=' . $row['id_librit'] . '&mode=h\'">Hiq</button><button class="button" onclick="document.location=\'ndryshoTirazhin.php?id=' . $row['id_librit'] . '&mode=sh\'">Shto</button></td>';
        $src_rez .= '<td>' . $row['autori'] . '</td>';
        $src_rez .= '<td>' . $row['kategoria'] . '</td>';
        $src_rez .= '<td><button class="button" onclick="document.location=\'fshiLiber.php?id=' . $row['id_librit'] . '\'">FSHI</button></td></tr>';
    }
    echo $src_rez;
    ?>
</div>
</body>
</html>