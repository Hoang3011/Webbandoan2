<?php
include "connect.php"; // Kết nối database

echo "<pre>";
print_r($_FILES);
print_r($_POST);
echo "</pre>";

// Kiểm tra xem có dữ liệu từ form không
if (isset($_POST['id']) && isset($_POST['Name']) && isset($_POST['Price']) && isset($_POST['Describtion']) && isset($_POST['Type']) && isset($_POST['Visible'])) {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    // Lọc dấu chấm và chia cho 1000
    $price = intval(str_replace('.', '', $_POST['Price'])) / 1000;
    $price = mysqli_real_escape_string($conn, $price);
    $desc = mysqli_real_escape_string($conn, $_POST['Describtion']);
    $type = mysqli_real_escape_string($conn, $_POST['Type']);
    $visible = intval($_POST['Visible']); // Lấy giá trị Visible (0 hoặc 1)

    // Kiểm tra xem có hình ảnh mới không
    if (isset($_FILES['Images']) && $_FILES['Images']['error'] == 0) { // Đổi 'Image' thành 'Images'
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
        // Nếu không có hình ảnh mới, sử dụng hình ảnh cũ
        $sql = "SELECT Image FROM sanpham WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            $image_path = $row['Image']; // Dùng lại đường dẫn hình ảnh cũ
        } else {
            echo "Không tìm thấy sản phẩm!";
            exit();
        }
    }

    // Cập nhật dữ liệu vào database với Prepared Statements
    $stmt = $conn->prepare("UPDATE sanpham SET Name = ?, Price = ?, Describtion = ?, Type = ?, Image = ?, Visible = ? WHERE ID = ?");
    $stmt->bind_param("sdsssii", $name, $price, $desc, $type, $image_path, $visible, $id);
    if ($stmt->execute()) {
        header("Location: adminproduct.php"); // Chuyển hướng về trang quản lý sản phẩm
        exit();
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $stmt->error;
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