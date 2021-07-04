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
    $count = 0;
    $sql = 'SELECT kategoria from `kategoria_librit`';
    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['kategoria'] == $_POST['kategoria']) {
            $count = $count + 1;
        }
    }
    $kategoria = mysqli_real_escape_string($con, $_POST['kategoria']);
    if ($count == 0) {
        $sqli = "INSERT INTO `kategoria_Librit`(`id_kategori`, `kategoria`) VALUES ( NULL ,'$kategoria')";
        mysqli_query($con,$sqli );
    }
    else{
        $message = "Kategoria ekziston tashme.";
        echo "<script type='text/javascript'>alert('$message');</script>";}
}
?>
<script>
    window.history.back();
</script>


