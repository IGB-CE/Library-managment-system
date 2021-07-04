<?php
require_once 'lidhja.inc.php';
session_start();
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $password = md5($password);
    $query = "SELECT * FROM student WHERE email = '$email' AND password = '$password'";
    $res = mysqli_query($con, $query);
    $count = 0;
    $row = mysqli_fetch_assoc($res);
    $count = mysqli_num_rows($res);
    if (mysqli_num_rows($res) > 0 && $row['aktivizuar'] == 1) {
        $query = "SELECT * FROM `student` WHERE email = '" . $email . "'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_array($res);
        $_SESSION['emri'] = $row['emri'];
        $_SESSION['mbiemri'] = $row['mbiemri'];
        $_SESSION['niveli'] = $row['niveli'];
        $_SESSION['viti'] = $row['viti'];
        $_SESSION['roli'] = 'student';
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['password'] = $_POST["password"];
        $_SESSION['id'] = $row['id'];
        header("location:student/index.php");
    } else {
        ?>
        <script>
            window.alert("Personi nuk ekziston ose llogaria juaj nuk eshte me e vlefshme.");
            window.history.back();
        </script>
        <?php
    }
}
if (isset($_POST['submita'])) {
    $count = 0;
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $password = md5($password);
    $res = mysqli_query($con, "SELECT * FROM `admin` WHERE email='" . $email . "' && password='" . $password . "'");
    $row = mysqli_fetch_assoc($res);
    $count = mysqli_num_rows($res);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION['roli'] = 'admin';
        $_SESSION['emri'] = 'admin';
        header("location:admin/index.php");
    } else {
        ?>
        <script>
            window.alert("Personi nuk ekziston.");
            window.history.back();
        </script>
        <?php
    }
}
?>