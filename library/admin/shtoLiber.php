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
if (isset($_POST['submit'])) {
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Format invalid.");
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File ka permasa me te medha se cduhet.");
        if (in_array($filetype, $allowed)) {
            if (file_exists("/upload/" . $filename)) {
                $message = $filename . " ekziston tashme.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../upload/" . $filename);
            }
        } else {
            $message = "Nuk u ngarkua fotoja.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        $message = "Error: " . $_FILES["photo"]["error"];
    }
    $count = 0;
    $sql = "SELECT isbn from `libri`";
    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['isbn'] == $_POST['isbn']) {
            $count = $count + 1;
        }
    }
    if ($count == 0) {
        $isbn = $_POST['isbn'];
        $titulli = $_POST['titulli'];
        $botimi = $_POST['botimi'];
        $publikuesi = $_POST['publikuesi'];
        $copyright = $_POST['viti'];
        $nr_faqeve = $_POST['nr_faqeve'];
        $tirazhi = $_POST['tirazhi'];
        $autori = $_POST['autori'];
        $kat = $_POST['kategoria'];
        $per = $_POST['pershkrimi'];

        $query = "SELECT * FROM `autori_librit` WHERE autori = '" . $autori . "'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $autori = $row['id_autor'];

        $query = "SELECT * FROM `kategoria_librit` WHERE kategoria = '" . $kat . "'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $kat = $row['id_kategori'];

        $sqli = "INSERT INTO `libri`( `isbn`, `titulli_librit`, `botimi`, `publikuesi`, `viti_copyright`, `nr_faqeve`, `tirazhi`,`permbledhje`, `kopertina`, `id_autorit`, `id_kategori`) VALUES( '$isbn', '$titulli','$botimi', '$publikuesi', '$copyright' , '$nr_faqeve' , '$tirazhi' ,'$per', '$filename', '$autori', '$kat')";
        echo $sqli;
        if(mysqli_query($con, $sqli)){
            $message = "Libri u shtua.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else{
            $message = "Libri nuk u shtua.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }else{
        $message = "Libri gjendet tashme.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>
<script>
</script>