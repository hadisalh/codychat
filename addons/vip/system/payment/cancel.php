<?php
session_start();
$ref = $_SESSION['paypal_ref'];
unset($_SESSION['paypal_ref']);
header('location: ' . $ref);
?>