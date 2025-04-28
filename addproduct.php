<?php
include "connect.php"; // Kết nối database

// Kiểm tra xem form đã được submit và các trường bắt buộc có tồn tại không
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Name']) && isset($_POST['Price']) && isset($_POST['Describtion']) && isset($_POST['Type'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    
    // Xử lý giá: bỏ dấu chấm, bỏ 3 số 0 cuối, ép kiểu về số
    $price_input = $_POST['Price'];
    $price_cleaned = str_replace('.', '', $price_input); // Bỏ dấu chấm
    $price = (double)($price_cleaned / 1000); // Bỏ 3 số 0 cuối và ép kiểu về số
    
    $desc = mysqli_real_escape_string($conn, $_POST['Describtion']);
    $type = mysqli_real_escape_string($conn, $_POST['Type']);

    // Kiểm tra xem có hình ảnh được tải lên không
    if (isset($_FILES['Images']) && $_FILES['Images']['error'] == 0) {
        $image = $_FILES['Images'];
        $image_name = time() . "_" . basename($image['name']);
        $target_dir = "assets/img/products/";
        $target_file = $target_dir . $image_name;

        // Kiểm tra file có phải là hình ảnh không
        $check = getimagesize($image['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($image['tmp_name'], $target_file)) {
                $image_path = $target_file; // Đường dẫn ảnh mới
            } else {
                echo "Lỗi khi tải hình ảnh lên.";
                exit();
            }
        } else {
            echo "Tệp không phải là hình ảnh.";
            exit();
        }
    } else {
        echo "Vui lòng tải lên một hình ảnh.";
        exit();
    }

    // Thêm dữ liệu vào database với Prepared Statements
    $stmt = $conn->prepare("INSERT INTO sanpham (Name, Price, Describtion, Type, Image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsss", $name, $price, $desc, $type, $image_path);
    if ($stmt->execute()) {
        header("Location: adminproduct.php"); // Chuyển hướng về trang quản lý sản phẩm
        exit();
    } else {
        echo "Lỗi khi thêm dữ liệu: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Dữ liệu không hợp lệ!";
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
}

mysqli_close($conn);
?>