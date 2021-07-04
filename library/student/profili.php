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
if (isset($_POST['ndrysho'])) {
    $id = $_SESSION['id'];
    $pass_ri = $_POST['pass_ri'];
    $pass_ri_k = $_POST['pass_ri_k'];
    $result = "SELECT *from student WHERE id='$id'";
    $rezultati = mysqli_query($con, $result);
    $password_row = mysqli_fetch_array($rezultati);
    $database_password = $password_row['password'];
    if ($pass_ri == $pass_ri_k) {
        $pass_ri = mysqli_real_escape_string($con, md5($pass_ri));
        $str = "UPDATE `student` SET password='$pass_ri' WHERE id='$id'";
        $rezultati = mysqli_query($con, $str);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Profili </title>
    <link rel="stylesheet" href="../stili.css">
    <script defer src="../js/password.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
    <style>
        .butoni {
            width: 100%;
            line-height: 60px;
            height: 50px;
            max-width: 500px;
            border-radius: 5px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            display: inline-block;
            padding: 0 20px;
            background-color: #7c8291;
            background-size: 100%;
            border: solid 1px #7e8086;
            border-bottom-width: 3px;
            color: white;
            outline: none;
            cursor: pointer;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;

        }
    </style>
</head>
<body>
<?php
include_once '../navbar.php';
?>
<div class="register-wrapper">
    <div class="register-block">
        <h3 class="register-title">Profili juaj</h3>
        <form action="" method="post" onsubmit="return validatePassword()">
            <input type="text" name="emri" placeholder="Emri: <?php echo $_SESSION['emri'] ?>" readonly>
            <input type="text" name="mbiemri" placeholder="Mbiemri: <?php echo $_SESSION['mbiemri'] ?>" readonly>
            <input type="email" name="email" placeholder="Emaili: <?php echo $_SESSION['email'] ?>" readonly>
            <input type="text" name="niveli" placeholder="Niveli akademik: <?php echo $_SESSION['niveli'] ?>" readonly>
            <input type="number" name="viti" placeholder="Viti: <?php echo $_SESSION['viti'] ?>" readonly>
            <p>Ndryshoni passwordin:</p>
            <input type="password" name="pass_ri" id="pass1" required placeholder="Vendosni passwordin e ri">
            <input type="password" name="pass_ri_k" id="pass2" placeholder="Konfirmoni passwordin e ri" required>
            <div class="err" id="passE"></div>
            <input type="submit" class="butoni" name="ndrysho" id="ndrysho" value="Ndrysho Passwordin">
        </form>
    </div>
</div>
<?php
include_once '../footer.php';
?>
</body>
</html>