<?php
include_once "./connect.php"; // Kết nối database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $madh = isset($_POST['madh']) ? intval($_POST['madh']) : 0;
    $trangthai = isset($_POST['trangthai']) ? $_POST['trangthai'] : '';

    // Kiểm tra dữ liệu hợp lệ
    $valid_statuses = ['Chưa xác nhận', 'Đã xác nhận', 'Đã giao thành công', 'Đã hủy đơn'];
    if ($madh > 0 && in_array($trangthai, $valid_statuses)) {
        // Cập nhật trạng thái vào bảng donhang
        $sql = "UPDATE donhang SET trangthai = ? WHERE madh = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $trangthai, $madh);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }

        $stmt->close();
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}

$conn->close();
?>