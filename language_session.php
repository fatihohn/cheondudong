<?php
session_start();
include 'cdd_db_conn.php';
// $language = $_GET['q'];
if(isset($_GET['url']) && $_GET['url'] !== "") {
    $URL = $_GET['url'];
} else {
    $URL = "./home.php";
}
if(isset($_POST['language']) && $_POST['language'] !== "") {
    $language = mysqli_real_escape_string($conn, $_POST['language']);
} else {
    $language = mysqli_real_escape_string($conn, $_GET['language']);
}
// $language = $_POST['language'];

$_SESSION['language']=$language;

?>
    <script>
        location.replace("<?=$URL?>");
    </script>