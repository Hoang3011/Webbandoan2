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

    <div class="home-service" id="home-service">
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

// Trang hiện tại (mặc định là 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

// Tính OFFSET
$offset = ($page - 1) * $limit;

// Lấy danh sách sản phẩm phân trang
$stmt = $conn->prepare("SELECT * FROM sanpham LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Lấy tổng số sản phẩm để tính tổng số trang
$total_result = $conn->query("SELECT COUNT(*) as total FROM sanpham");
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ($total_products > 0) ? ceil($total_products / $limit) : 1;
?>


      <!-- Products -->
    <?php
    // Số sản phẩm trên mỗi trang
    $limit = 12;

    // Trang hiện tại (mặc định là 1)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1);

    // Tính OFFSET
    $offset = ($page - 1) * $limit;

    // Lấy tham số tìm kiếm
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $category = isset($_GET['category']) ? trim($_GET['category']) : '';
    $min_price = isset($_GET['min_price']) && is_numeric($_GET['min_price']) ? (int)$_GET['min_price'] : '';
    $max_price = isset($_GET['max_price']) && is_numeric($_GET['max_price']) ? (int)$_GET['max_price'] : '';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $Type = isset($_GET['Type']) ? trim($_GET['Type']) : '';

    // Debug: Log received parameters
    /*
    echo "<pre>";
    echo "Keyword: " . htmlspecialchars($keyword) . "\n";
    echo "Category: " . htmlspecialchars($category) . "\n";
    echo "Type: " . htmlspecialchars($Type) . "\n";
    echo "Min Price: " . htmlspecialchars($min_price) . "\n";
    echo "Max Price: " . htmlspecialchars($max_price) . "\n";
    echo "Sort: " . htmlspecialchars($sort) . "\n";
    echo "</pre>";
    */

    // Xây dựng truy vấn SQL
    $sql = "SELECT * FROM sanpham WHERE 1=1";
    $params = [];
    $types = "";

    // Thêm điều kiện tìm kiếm theo từ khóa
    if (!empty($keyword)) {
        $sql .= " AND Name LIKE ?";
        $params[] = "%$keyword%";
        $types .= "s";
    }

    // Thêm điều kiện tìm kiếm theo danh mục (từ advanced search hoặc navigation)
    if (!empty($category)) {
        $sql .= " AND Type = ?";
        $params[] = $category;
        $types .= "s";
    } elseif (!empty($Type)) {
        $sql .= " AND Type = ?";
        $params[] = $Type;
        $types .= "s";
    }

    // Thêm điều kiện tìm kiếm theo giá
    if ($min_price !== '') {
        $sql .= " AND Price >= ?";
        $params[] = $min_price;
        $types .= "i";
    }
    if ($max_price !== '') {
        $sql .= " AND Price <= ?";
        $params[] = $max_price;
        $types .= "i";
    }

    // Thêm sắp xếp
    if ($sort === 'asc') {
        $sql .= " ORDER BY Price ASC";
    } elseif ($sort === 'desc') {
        $sql .= " ORDER BY Price DESC";
    }

    // Thêm phân trang
    $sql .= " LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= "ii";

    // Chuẩn bị và thực thi truy vấn
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Lấy tổng số sản phẩm để tính tổng số trang
    $total_sql = "SELECT COUNT(*) as total FROM sanpham WHERE 1=1";
    $total_params = [];
    $total_types = "";

    if (!empty($keyword)) {
        $total_sql .= " AND Name LIKE ?";
        $total_params[] = "%$keyword%";
        $total_types .= "s";
    }
    if (!empty($category)) {
        $total_sql .= " AND Type = ?";
        $total_params[] = $category;
        $total_types .= "s";
    } elseif (!empty($Type)) {
        $total_sql .= " AND Type = ?";
        $total_params[] = $Type;
        $total_types .= "s";
    }
    if ($min_price !== '') {
        $total_sql .= " AND Price >= ?";
        $total_params[] = $min_price;
        $total_types .= "i";
    }
    if ($max_price !== '') {
        $total_sql .= " AND Price <= ?";
        $total_params[] = $max_price;
        $total_types .= "i";
    }

    $total_stmt = $conn->prepare($total_sql);
    if (!empty($total_params)) {
        $total_stmt->bind_param($total_types, ...$total_params);
    }
    $total_stmt->execute();
    $total_result = $total_stmt->get_result();
    $total_row = $total_result->fetch_assoc();
    $total_products = $total_row['total'];
    $total_pages = ($total_products > 0) ? ceil($total_products / $limit) : 1;

    // Kiểm    // Kiểm tra xem có phải là kết quả tìm kiếm không
    $is_search = !empty($keyword) || !empty($category) || !empty($Type) || $min_price !== '' || $max_price !== '';
    ?>

    <div class="Products" id="product-list">
        <div class="container">
            <div class="row">
                <?php if ($total_products > 0): ?>
                    <div class="col-xl-12">
                        <div class="inner-title">
                            <?php echo $is_search ? 'Kết quả tìm kiếm' : 'Khám phá thực đơn của chúng tôi'; ?>
                        </div>
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
                <?php else: ?>
                    <div class="col-xl-12">
                        <div class="home-products" id="home-products">
                            <div class="no-result">
                                <div class="no-result-h">Tìm kiếm không có kết quả</div>
                                <div class="no-result-p">Xin lỗi, chúng tôi không thể tìm được kết quả hợp với tìm kiếm của bạn</div>
                                <div class="no-result-i"><i class="fa-light fa-face-sad-cry"></i></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Phân trang -->
    <div id="pagination" class="Pagination">
        <div class="container">
            <ul>
                <?php
                // Tạo URL cơ bản với các tham số tìm kiếm
                $base_url = 'index.php?';
                $url_params = [];
                if (!empty($keyword)) {
                    $url_params[] = 'keyword=' . urlencode($keyword);
                }
                if (!empty($category)) {
                    $url_params[] = 'category=' . urlencode($category);
                }
                if (!empty($Type)) {
                    $url_params[] = 'Type=' . urlencode($Type);
                }
                if ($min_price !== '') {
                    $url_params[] = 'min_price=' . $min_price;
                }
                if ($max_price !== '') {
                    $url_params[] = 'max_price=' . $max_price;
                }
                if (!empty($sort)) {
                    $url_params[] = 'sort=' . $sort;
                }
                $base_url .= implode('&', $url_params);

                for ($i = 1; $i <= $total_pages; $i++) {
                    $active_class = ($i == $page) ? 'trang-chinh' : '';
                    $page_url = $base_url . (empty($url_params) ? '' : '&') . 'page=' . $i;
                    echo '<li><a href="' . htmlspecialchars($page_url) . '" class="inner-trang ' . $active_class . '">' . $i . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <?php if ($is_search && $total_products > 0): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('home-service').scrollIntoView({ behavior: 'smooth' });
            });
        </script>
    <?php endif; ?>

    <!-- Footer -->
    <?php include_once "includes/footer.php"; ?>

    <!-- JavaScript -->
    <script>
        function submitSearchForm() {
            document.getElementById('search-form').submit();
        }

        // Synchronize keyword from main search bar to advanced search form
        document.getElementById('advanced-search-form').addEventListener('submit', function() {
            const searchInput = document.getElementById('search-input').value;
            document.getElementById('advanced-keyword').value = searchInput;
        });
    </script>
</body>
</html>