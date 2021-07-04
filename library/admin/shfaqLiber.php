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
$sql = "SELECT libri.id_librit, libri.isbn,libri.titulli_librit,libri.botimi, libri.publikuesi,libri.viti_copyright, libri.nr_faqeve, libri.tirazhi, autori_librit.autori, kategoria_librit.kategoria FROM libri INNER JOIN autori_librit ON libri.id_autorit=autori_librit.id_autor INNER JOIN kategoria_librit ON libri.id_kategori=kategoria_librit.id_kategori";
session_start();
$r_query = mysqli_query($con, $sql);
$src_rez = ' <table border="1"><thead> 
                 <tr><th>Seria</th>
                 <th>ISBN</th>
                 <th>Titulli</th>
                 <th>Botimi</th>
                 <th>Publikuesi</th>
                 <th>Copyright</th>
                 <th>Nr_faqeve</th>
                 <th>Tirazhi</th>
                 <th>Autori</th>
                 <th>Kategori</th>
                 <th>Veprime</th></tr>
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
        $src_rez .= '<td>' . $row['tirazhi'] . '</td>';
        $src_rez .= '<td>' . $row['autori'] . '</td>';
        $src_rez .= '<td>' . $row['kategoria'] . '</td>';
        $src_rez .= '<td><button onclick="document.location=\'php/fshiLiber.php?id=' . $row['id_librit'] . '\'">FSHI</button></td></tr>';
}
$_SESSION['rez'] = $src_rez;
?>
<script>
        window.history.back();
</script>


