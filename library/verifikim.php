<!DOCTYPE html>
<?php
require_once 'lidhja.inc.php';
session_start();
if (isset($_SESSION["roli"])) {
    if ($_SESSION['roli'] == 'admin')
        header("location:admin/index.php");
    else
        header("location:student/index.php");
}
if (!isset($_SESSION["val"])){
    header("location:rregjistrim.php");
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title> Biblioteka Online-FTI </title>
    <link rel="stylesheet" href="stili.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body>
<header>
    <div class="navbar">
        <a href="index.php" class="logo"> FTI-LIBRARIA ONLINE </a>
    </div>
    <div class="register-wrapper">
        <div class="register-block">
            <h3 class="register-title">Aktivizimi i llogarise</h3>
            <form method="post" action="verifikim.php">
                <input type="number" placeholder="Vendosni kodin qe derguam ne email-in tuaj" name="kodi">
                <input type="submit" name="verifiko" value="Kontrollo">
                <input type="submit" name="tjeter" value="Merr kod tjeter">
            </form>
        </div>
    </div>
</header>
<?php
if (isset($_POST['verifiko'])) {
    $sql = "SELECT * FROM `verifikim` WHERE id_student=$_SESSION[id]";
    $rez = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($rez);
    $skadenca = $row['vlefshmeria'];
    $tani = date('Y-m-d H:i:s');
    if ($tani > $skadenca) {
        $message = "Kodi juaj ka skaduar";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        if ($row['kodi'] == $_POST['kodi']) {
            mysqli_query($con, "UPDATE `student` SET `aktivizuar`=1 WHERE `id`=$_SESSION[id]");
            mysqli_query($con, "DELETE FROM `verifikim` WHERE `id_student`=$_SESSION[id]");
            header("location:index.php");
        } else {
            $message = "Kodi qe dhate nuk eshte i sakte!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}

if (isset($_POST['tjeter'])) {
    $otp = rand(100000, 999999);
    $expire_stamp = date('Y-m-d H:i:s', strtotime("+5 min"));
    $now_stamp = date("Y-m-d H:i:s");
    $sql = "UPDATE `verifikim` SET `kodi`=$otp, `vlefshmeria`=$expire_stamp WHERE `id_student`=$_SESSION[id];";
    mysqli_query($con, $sql);
    $to = "" . $_SESSION['email'];
    $subject = "Kodi i verifkimit per t'u rregjistruar ne platformen e biblotekes online FTI";
    $msg = "" . $otp;
    $from = "From: ftibiblioteka@gmail.com";
    if (mail($to, $subject, $msg, $from)) {
        $message = "Kontrolloni emailin tuaj!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $message = "Ndodhi nje problem ne email!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>
</body>
</html>