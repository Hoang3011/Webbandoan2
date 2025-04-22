<?php
session_start();
include 'connect.php';
$makh = $_SESSION['makh']; // người dùng đã đăng nhập
$masp = $_POST['masp'];
$sql = "SELECT Price FROM sanpham WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $masp);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
if ($result) {
    $dongia = $result['Price'];
    $check = $conn->prepare("SELECT * FROM giohang WHERE makh = ? AND masp = ?");
    $check->bind_param("ii", $makh, $masp);
    $check->execute();
    $exists = $check->get_result()->fetch_assoc();

    if ($exists) {
        // cập nhật số lượng +1
        $conn->query("UPDATE giohang SET soluong = soluong + 1 WHERE makh = $makh AND masp = $masp");
    } else {
        // thêm mới
        $insert = $conn->prepare("INSERT INTO giohang (makh, masp, soluong, dongia) VALUES (?, ?, 1, ?)");
        $insert->bind_param("iid", $makh, $masp, $dongia);
        $insert->execute();
    }

    echo json_encode(['status' => 'success', 'message' => 'Đã thêm sản phẩm vào giỏ']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Sản phẩm không tồn tại']);
}
?>
