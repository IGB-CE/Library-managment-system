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
    if (!empty($_REQUEST['searchbar'])) {
        $src = mysqli_real_escape_string($con, $_POST['searchbar']);
        $sql = "SELECT * FROM libri WHERE titulli_librit LIKE '%" . $src . "%'";
        $r_query = mysqli_query($con, $sql);
        $src_rez = ' <table border="1"><thead> 
                 <tr><td>id_librit</td>
                 <td>isbn</td>
                 <td>titulli_librit</td>
                 <td>botimi</td>
                 <td>publikuesi</td>
                 <td>viti_copyright</td>
                 <td>nr_faqeve</td>
                 <td>tirazhi</td>
                 <td>status</td>
                 <td>id_autorit</td>
                 <td>id_kategori</td></tr>
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
            $src_rez .= '<td>' . $row['status'] . '</td>';
            $src_rez .= '<td>' . $row['id_autorit'] . '</td>';
            $src_rez .= '<td>' . $row['id_kategori'] . '</td></tr>';
        }
    }
    $_SESSION['rez'] = $src_rez;
}
?>
<script>
    window.history.back();
</script>

