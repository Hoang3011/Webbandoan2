<?php
include "../connect.php";

$category = isset($_POST['category']) ? $_POST['category'] : "";
$search = isset($_POST['search']) ? $_POST['search'] : "";
$page = max(1, (int)$_POST['page']);
$limit = 12;
$start = ($page - 1) * $limit;

// Đếm tổng số sản phẩm phù hợp
$count_sql = "SELECT COUNT(*) as total FROM sanpham WHERE 1";
if ($category != "") {
    $count_sql .= " AND Type = '" . mysqli_real_escape_string($conn, $category) . "'";
}
if ($search != "") {
    $count_sql .= " AND Name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
}
$count_result = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_result);
$total = $count_row['total'];
$total_pages = ceil($total / $limit);

// Truy vấn lấy sản phẩm trang hiện tại
$sql = "SELECT * FROM sanpham WHERE 1";
if ($category != "") {
    $sql .= " AND Type = '" . mysqli_real_escape_string($conn, $category) . "'";
}
if ($search != "") {
    $sql .= " AND Name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
}
$sql .= " LIMIT $start, $limit";

$result = mysqli_query($conn, $sql);

// Nếu có kết quả thì hiển thị trong .row
if (mysqli_num_rows($result) > 0) {
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="col-12">
            <div class="list">
                <div class="list-left">
                    <img src="' . $row['Image'] . '" alt="' . $row['Name'] . '">
                    <div class="list-info">
                        <h4>' . $row['Name'] . '</h4>
                        <p>' . $row['Describtion'] . '</p>
                        <div class="list-category">' . $row['Type'] . '</div>
                    </div>
                </div>
                <div class="list-right">
                    <div class="list-price">' . $row['Price'] . '.000₫</div>
                    <div class="list-control">
                        <div class="list-tool">
                            <a href="adminchangeproduct.php?id=' . $row['ID'] . '" class="btn-edit"><i class="fa-light fa-pen-to-square"></i></a>
                            <button class="btn-delete" onclick="confirmDelete(' . $row['ID'] . ')"><i class="fa-regular fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
    echo '</div>'; // Kết thúc .row
} else {
    // KHÔNG đặt trong .row
    echo '<div class="col-12"><div class="no-result"><div class="no-result-h">Tìm kiếm không có kết quả</div><div class="no-result-p">Xin lỗi, chúng tôi không thể tìm được kết quả hợp với tìm kiếm của bạn</div><div class="no-result-i"><i class="fa-light fa-face-sad-cry"></i></div></div></div>';
}

// Phân trang
if ($total_pages > 1) {
    echo '<div class="Pagination"><div class="container"><ul>';
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $page) ? 'trang-chinh' : '';
        echo '<li><a href="#" class="inner-trang ' . $active_class . '" onclick="fetchProductsPage(' . $i . ')">' . $i . '</a></li>';
    }
    echo '</ul></div></div>';
}

mysqli_close($conn);
?>
