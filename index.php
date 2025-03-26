
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="assets/font-awesome-pro-v6-6.2.0/css/all.min.css"
    />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/style.css" />

    <title>Đặc sản 3 miền</title>
    <link href="./assets/img/logo.png" rel="icon" type="image/x-icon" />
  </head>

  <body>
  <!-- Header --> 
    <?php
    include "includes/header.php";
    ?>
  <!-- Close Header -->
    <!-- Banner -->

    <div class="Banner">
      <div class="container">
        <div class="inner-img">
          <img src="assets/img/banner.jpg" alt="banner" />
        </div>
      </div>
    </div>

    <!-- End Banner -->

    <!-- Service -->

    <div class="Service">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="inner-item">
              <div class="inner-icon">
                <i class="fa-solid fa-truck-fast"></i>
              </div>
              <div class="inner-info">
                <div class="inner-chu1">GIAO HÀNG NHANH</div>
                <div class="inner-chu2">Cho tất cả đơn hàng</div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="inner-item">
              <div class="inner-icon">
                <i class="fa-solid fa-shield-heart"></i>
              </div>
              <div class="inner-info">
                <div class="inner-chu1">SẢN PHẨM AN TOÀN</div>
                <div class="inner-chu2">Cam kết chất lượng</div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="inner-item">
              <div class="inner-icon">
                <i class="fa-solid fa-headset"></i>
              </div>
              <div class="inner-info">
                <div class="inner-chu1">HỖ TRỢ 24/7</div>
                <div class="inner-chu2">Tất cả ngày trong tuần</div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="inner-item">
              <div class="inner-icon">
                <i class="fa-solid fa-coins"></i>
              </div>
              <div class="inner-info">
                <div class="inner-chu1">HOÀN LẠI TIỀN</div>
                <div class="inner-chu2">Nếu không hài lòng</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End Service -->
    <?php
    include "connect.php";

    // Số sản phẩm trên mỗi trang
    $limit = 12;

    // Xác định trang hiện tại (mặc định là 1)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1); // Đảm bảo trang không nhỏ hơn 1

    // Tính OFFSET
    $offset = ($page - 1) * $limit;

    // Truy vấn danh sách sản phẩm theo phân trang
    $stmt = $conn->prepare("SELECT * FROM sanpham LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
     // Lấy tổng số sản phẩm để tính tổng số trang (chỉ cần tính 1 lần)
     $total_result = $conn->query("SELECT COUNT(*) as total FROM sanpham");
     $total_row = $total_result->fetch_assoc();
     $total_products = $total_row['total'];
     $total_pages = ($total_products > 0) ? ceil($total_products / $limit) : 1;
?>

      <!-- Products -->


      <div class="Products">
          <div class="container">
              <div class="row">
                  <div class="col-xl-12">
                      <div class="inner-title">Khám phá thực đơn của chúng tôi</div>
                  </div> 

                  <?php while ($row = $result->fetch_assoc()): ?>
                  <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                      <div class="inner-item">
                          <a href="chitietsp.php?id=<?= $row['ID']; ?>" class="inner-img">
                              <img src="<?= htmlspecialchars($row['Image']); ?>" />
                          </a>
                          <div class="inner-info">
                              <div class="inner-ten"><?= htmlspecialchars($row['Name']); ?></div>
                              <div class="inner-gia"><?= number_format($row['Price']); ?>.000 ₫</div>
                              <a href="chitietsp.php?id=<?= $row['ID']; ?>" class="inner-muahang">
                                  <i class="fa-solid fa-cart-plus"></i> ĐẶT MÓN
                              </a>
                          </div>
                      </div>
                  </div>
                  <?php endwhile; ?>
              </div> <!-- Đóng row đúng chỗ -->
          </div>
      </div>

              <!-- Đóng Products -->

      
    </div>
    

    <!-- Phân trang -->
<div class="Pagination">
    <div class="container">
        <ul>
        <?php
    // Hiển thị tất cả các trang từ 1 đến tổng số trang
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $page) ? 'trang-chinh' : '';
        echo '<li><a href="?page=' . $i . '" class="inner-trang ' . $active_class . '">' . $i . '</a></li>';
    }
?>
        </ul>
    </div>
</div>
<!-- Đóng phân trang -->
 <!-- Footer -->
    <?php
    include_once "includes/footer.php";
     ?>
  <!-- Close Header -->