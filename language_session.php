<?php
session_start();
include 'cdd_db_conn.php';
// $language = $_GET['q'];
$language = mysqli_real_escape_string($conn, $_POST['language']);
// $language = $_POST['language'];

$_SESSION['language']=$language;

?>
    <script>
        location.replace("./home.php");
    </script>
    <?php


}
?>
<!-- if(!isset($SESSION['language'])) {
    echo "session fail";
    echo var_dump($_SESSION);
    echo error_log($conn);
} else {
    ?>
    <script>
        location.replace("./home.php");
    </script>
    <?php -->