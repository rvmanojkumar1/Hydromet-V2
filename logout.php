<?php
session_start();
include('database.php');

session_destroy();
header('location:index.php');
?>
