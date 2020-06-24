<?php
session_start();
$language = $_GET['q'];

$_SESSION['language'] = $language;

// if(isset($SESSION['language'])) {
    ?>
    <script>
        location.href = "./index.php";
    </script>
    <?php
// }
?>