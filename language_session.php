<?php
session_start();
$language = $_GET['q'];

$_SESSION['language'] = $language;


?>