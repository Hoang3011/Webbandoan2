<?php
session_start();
include 'connect.php';

$makh = $_SESSION['makh'];
$masp = $_POST['masp'];
$soluong = $_POST['soluong'];

if ($soluong <= 0) {
    $conn->query("DELETE FROM giohang WHERE makh = $makh AND masp = $masp");
} else {
    $stmt = $conn->prepare("UPDATE giohang SET soluong = ? WHERE makh = ? AND masp = ?");
    $stmt->bind_param("iii", $soluong, $makh, $masp);
    $stmt->execute();
}
?>
