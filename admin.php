<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/font-awesome-pro-v6-6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="admin/css/style.css" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/admin.css" />
    <title>Admin</title>
    <link href="./assets/img/logo.png" rel="icon" type="image/x-icon" />
</head>
<body>
    <?php
    // Start session if needed for additional security
    session_start();

    // Include database connection
    include_once "connect.php";

    // Function to get cookie
    function getCookie($name) {
        $nameEQ = $name . "=";
        $ca = explode(';', $_SERVER['HTTP_COOKIE'] ?? '');
        foreach ($ca as $c) {
            $c = trim($c);
            if (strpos($c, $nameEQ) === 0) {
                return substr($c, strlen($nameEQ));
            }
        }
        return null;
    }

    // Check for username cookie
    $username = getCookie("username");
    $password = getCookie("password");

    if ($username !== null && $password !== null) {
        // Prepare SQL query to check if username and password match in nhanvien table
        $sql = "SELECT * FROM nhanvien WHERE tennv = ? AND mk = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Valid credentials, proceed to display admin page
                $stmt->close();
            } else {
                // Invalid credentials, redirect to adminlogin.php
                $stmt->close();
                header("Location: adminlogin.php");
                exit();
            }
        } else {
            // SQL preparation failed, redirect to adminlogin.php
            header("Location: adminlogin.php");
            exit();
        }
    } else {
        // No cookies, redirect to adminlogin.php
        header("Location: adminlogin.php");
        exit();
    }

    // Original admin page logic
    include_once "includes/headeradmin.php";

    // 1. Tổng số khách hàng
    $sql_khachhang = "SELECT COUNT(*) as total_kh FROM khachhang";
    $result_khachhang = $conn->query($sql_khachhang);
    $total_khachhang = $result_khachhang->fetch_assoc()['total_kh'];

    // 2. Tổng số sản phẩm
    $sql_sanpham = "SELECT COUNT(*) as total_sp FROM sanpham";
    $result_sanpham = $conn->query($sql_sanpham);
    $total_sanpham = $result_sanpham->fetch_assoc()['total_sp'];

    // 3. Tổng doanh thu (chỉ tính đơn hàng thành công)
    $sql_doanhthu = "SELECT SUM(tongtien) as total_dt FROM donhang WHERE trangthai = 'Đã giao thành công'";
    $result_doanhthu = $conn->query($sql_doanhthu);
    $total_doanhthu = $result_doanhthu->fetch_assoc()['total_dt'] ?? 0;
    $total_doanhthu_formatted = number_format($total_doanhthu, 0, ',', '.') . "₫";
    ?>

    <div class="Tongquan">
        <div class="inner-gth pt-3 pb-2 mb-3">
           <h1 class="page-title">Trang tổng quát của cửa hàng Đặc sản 3 miền</h1>
        </div>

        <div class="giaodien">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="inner-item">
                        <div class="inner-box">
                            <div class="inner-so"><?php echo $total_khachhang; ?></div>
                            <div class="inner-img">
                                <img src="assets/img/admin/s1.png" />
                            </div>
                            <div class="inner-title">Khách hàng</div>
                            <p class="inner-desc">
                                Sản phẩm là bất cứ cái gì có thể đưa vào thị trường để tạo
                                sự chú ý, mua sắm, sử dụng hay tiêu dùng nhằm thỏa mãn một
                                nhu cầu hay ước muốn. Nó có thể là những vật thể, dịch vụ,
                                con người, địa điểm, tổ chức hoặc một ý tưởng.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="inner-item">
                        <div class="inner-box">
                            <div class="inner-so"><?php echo $total_sanpham; ?></div>
                            <div class="inner-img">
                                <img src="assets/img/admin/s2.png" />
                            </div>
                            <div class="inner-title">Sản phẩm</div>
                            <p class="inner-desc">
                                Khách hàng mục tiêu là một nhóm đối tượng khách hàng trong
                                phân khúc thị trường mục tiêu mà doanh nghiệp bạn đang hướng
                                tới.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="inner-item">
                        <div class="inner-box">
                            <div class="inner-so"><?php echo $total_doanhthu_formatted; ?></div>
                            <div class="inner-img">
                                <img src="assets/img/admin/s3.png" />
                            </div>
                            <div class="inner-title">Doanh thu</div>
                            <p class="inner-desc">
                                Doanh thu của doanh nghiệp là toàn bộ số tiền sẽ thu được do
                                tiêu thụ sản phẩm, cung cấp dịch vụ với sản lượng.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="assets/js/admin.js"></script>
</body>
</html>