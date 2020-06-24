<?php
session_start();
$language = $_GET['q'];

$_SESSION['language'] = $language;


?>

<script>
    location.replace("./index.php");
</script>