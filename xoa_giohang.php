<?php
session_start();
include 'connect.php';
$makh = $_SESSION['makh'];
$masp = $_POST['masp'];

$conn->query("DELETE FROM giohang WHERE makh = $makh AND masp = $masp");
?>
