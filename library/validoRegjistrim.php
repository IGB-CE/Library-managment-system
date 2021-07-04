<?php
require_once 'lidhja.inc.php';
session_start();
if (isset($_POST['submit'])) {
    $count = 0;
    $sql = "SELECT email from `student`";
    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['email'] == $_POST['email']) {
            $count = $count + 1;
        }
    }
    if ($count == 0) {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $password = mysqli_real_escape_string($con, $_POST["password"]);
        $password = md5($password);
        mysqli_query($con, "INSERT INTO `student` VALUES('', '$_POST[emri]', '$_POST[mbiemri]', '$email', '$password', '$_POST[niveli]', $_POST[viti],0);");
        $otp = rand(100000, 999999);
        $expire_stamp = date('Y-m-d H:i:s', strtotime("+5 min"));
        $last_id = mysqli_insert_id($con);
        $now_stamp = date("Y-m-d H:i:s");
        $_SESSION['id'] = $last_id;
        $_SESSION['email']=$email;
        $_SESSION['val']=1;
        $sql = "INSERT INTO `verifikim`(`kodi`, `vlefshmeria`, `id_student`) VALUES ($otp,'$expire_stamp',$last_id);";
        mysqli_query($con, $sql);
        $to =$_POST['email'];
        $subject = "Kodi i verifkimit per t'u rregjistruar ne platformen e biblotekes online FTI";
        $msg = $otp;
        $from ='From: <ftibiblioteka@gmail.com>'."\r\n";
        $from.="MIME-Version: 1.0"."\r\n";
        $from.="Content-type:text/html;charset=UTF-8"."\r\n";
        if (mail($to, $subject, $msg, $from)) {
            ?>
            <script type="text/javascript">
                window.location.assign("verifikim.php");
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Dicka nuk shkoi sic duhet");
            </script>
            <?php
        }
    } else {
        ?>
        <script type="text/javascript">
                   alert("Perdoruesi ekziston tashme.");
                   window.history.back();
               </script>
        <?php
    }
}
?>