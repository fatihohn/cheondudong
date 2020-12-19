<?php
session_start();
include 'cdd_db_conn.php';
// $language = $_GET['q'];
if($_POST['language'] !== "") {
    $language = mysqli_real_escape_string($conn, $_POST['language']);
} else {
    $language = mysqli_real_escape_string($conn, $_GET['language']);
}
// $language = $_POST['language'];

$_SESSION['language']=$language;

?>
    <script>
        location.replace("./home.php");
    </script>