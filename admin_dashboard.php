<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["role"] != "admin") {
    header("Location: index.php");
    exit;
}
?>