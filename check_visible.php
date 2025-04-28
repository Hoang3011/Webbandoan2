<?php
include "./connect.php";

if (!$conn) {
    echo "error: Không thể kết nối đến cơ sở dữ liệu";
    exit;
}

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    
    // Kiểm tra giá trị Visible
    $sql = "SELECT Visible FROM sanpham WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['Visible'] == 1 ? "visible" : "hidden";
    } else {
        echo "error: Không tìm thấy sản phẩm";
    }
} else {
    echo "error: Không nhận được ID";
}

mysqli_close($conn);
?>