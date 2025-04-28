<?php
include "./connect.php";

if (!$conn) {
    echo "error: Không thể kết nối đến cơ sở dữ liệu";
    exit;
}

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    
    // Kiểm tra giá trị Visible
    $check_sql = "SELECT Visible FROM sanpham WHERE ID = '$id'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        $visible = $row['Visible'];

        if ($visible == 1) {
            // Cập nhật Visible = 0
            $update_sql = "UPDATE sanpham SET Visible = 0 WHERE ID = '$id'";
            if (mysqli_query($conn, $update_sql)) {
                echo "success";
            } else {
                echo "error: " . mysqli_error($conn);
            }
        } else {
            // Xóa sản phẩm
            $delete_sql = "DELETE FROM sanpham WHERE ID = '$id'";
            if (mysqli_query($conn, $delete_sql)) {
                echo "success";
            } else {
                echo "error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "error: Không tìm thấy sản phẩm";
    }
} else {
    echo "error: Không nhận được ID";
}

mysqli_close($conn);
?>