<?php
session_start();
$username = $_SESSION["username"];
if ($username == "")
    header('Location: ../View/login.php');
