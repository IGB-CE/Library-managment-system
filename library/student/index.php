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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Index </title>
    <link rel="stylesheet" href="../stili.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="libri.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body>
<div class="sticky">
    <?php
    if (isset($_GET['info'])) {
        echo $_GET['info'];
        unset($_GET['info']);
    }
    ?>
</div>
<?php
include_once '../navbar.php';
?>
</div>
<div id="large-th">
    <div class="container">
        <h1>Disa rekomandime</h1>
        <br>
        <div class="choose">
            <a href="#list-th"><i class="fa fa-th-list" aria-hidden="true"></i></a>
            <a href="#large-th"><i class="fa fa-th-large" aria-hidden="true"></i></a>
        </div>
        <div id="list-th">
            <?php
            $sql = "SELECT libri.id_librit, libri.isbn,libri.titulli_librit,libri.botimi, libri.publikuesi,libri.viti_copyright, libri.nr_faqeve,libri.tirazhi, libri.tirazhi, autori_librit.autori, kategoria_librit.kategoria, libri.kopertina FROM libri INNER JOIN autori_librit ON libri.id_autorit=autori_librit.id_autor INNER JOIN kategoria_librit ON libri.id_kategori=kategoria_librit.id_kategori WHERE tirazhi>0 ORDER BY RAND() LIMIT 6";
            $rez = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($rez)) {
                $k = $row['kopertina'];
                if ($k == '') {
                    $k = "default_book_cover.jpg";
                }
                $src_rez = '<div  style="cursor: pointer" class="book read" onclick="document.location=\'libri.php?id=' . $row['id_librit'] . '\'">';
                $src_rez .= '<div class="cover">';
                $src_rez .= "<img src='../upload/" . $k . "'>";
                $src_rez .= '</div>';
                $src_rez .= '<div class="description">';
                $src_rez .= '<p class="title">' . substr($row['titulli_librit'], 0, 15) . '...</br>';
                $src_rez .= '<span class="author">' . $row['autori'] . '</span></p>';
                $src_rez .= '</div>';
                $src_rez .= '</div>';

                echo $src_rez;
            }
            ?>
        </div>
        <h1>Me te fundit</h1>
        <br>
        <div id="list-th">
            <?php
            $sql = "SELECT libri.id_librit, libri.isbn,libri.titulli_librit,libri.botimi, libri.publikuesi,libri.viti_copyright, libri.nr_faqeve, libri.tirazhi, autori_librit.autori, kategoria_librit.kategoria, libri.kopertina FROM libri INNER JOIN autori_librit ON libri.id_autorit=autori_librit.id_autor INNER JOIN kategoria_librit ON libri.id_kategori=kategoria_librit.id_kategori  WHERE tirazhi>0
ORDER BY `libri`.`viti_copyright`  DESC  LIMIT 3";
            $rez = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($rez)) {
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
            ?>
        </div>
    </div>
    <p>
    <div class="bllok-map">
        <h3>Adresa:</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11986.586169491275!2d19.8216134!3d41.3165523!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdf5dc3ad387e1db5!2sFTI%20-%20Fakulteti%20Teknologjis%C3%AB%20s%C3%AB%20Informacionit!5e0!3m2!1sen!2s!4v1614010080991!5m2!1sen!2s"
                width="900" height="300" style="border:2;" allowfullscreen="" loading="lazy"></iframe>
        <h4><b> <i>
                    Orari:</i></b> Nga e Hena ne te Premten 08:00 - 14:00 !</h4></div>
    </p>
</div>
<div class="bllok-map">
    <h3>RREGULLORJA E BIBLIOTEKES</h3>
    <ul>
        <li>Studentet kane te drejte te rezervojne libra per nje afat kohore maksimal pre 5 ditesh.</li>
        <li>Studentet kane te drejte te anulojne librat qe kane kerkuar deri ne momentin qe kerkesa eshte pranuar nga
            admini.
        </li>
        <li>Anullimi i nje rezervimi te kerkuar duhet te behet para dates se terheqjes.</li>
        <li>Ne rast mosparaqitje per terheqjen e librave te pranuar ne daten e parashikuar administratori ka te drejte
            te refuzoj kerkesen e bere.
        </li>
        <li>Ne rast mosparaqitje per leshimin e librave ne daten e parashikuar administratoi ka te drejte t'ju
            caktivizoj nga biblioteka.
        </li>
        <li>Paraqitja ne bibliotek duhet te behet ne zbatim te rregullores ANTI-COVID.</li>
    </ul>
    <h3>Per cdo paqartesi apo problem kontaktoni ne email <b><a href="mailto: ftibiblioteka@gmail.com ">ftibiblioteka@gmail.com</a></b>.
    </h3>
</div>
<?php
include_once '../footer.php';
?>
</body>
</html>