<?php
session_start();
include 'cdd_db_conn.php';
// $language = $_GET['q'];
$language = mysqli_real_escape_string($conn, $_POST['language']);


$_SESSION['language'] = $language;

if(isset($SESSION['language'])) {
    ?>
    <script>
        location.replace("./home.php");
    </script>
    <?php
} else {
    echo "session fail";
}
?>