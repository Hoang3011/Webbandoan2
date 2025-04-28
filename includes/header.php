 <!-- header top  -->
<!-- <?php
session_start();
ob_start();

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to clean price input (remove thousand separators)
function cleanPrice($price) {
    if (empty($price)) return '';
    // Remove dots and any non-numeric characters
    return str_replace('.', '', $price);
}

// Process form submission
$min_price = '';
$max_price = '';
$keyword = '';
$category = '';
$sort = '';
$page = 1;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $min_price = isset($_GET['min_price']) ? cleanPrice($_GET['min_price']) : '';
    $max_price = isset($_GET['max_price']) ? cleanPrice($_GET['max_price']) : '';

    if (!is_numeric($min_price) && $min_price !== '') {
        $min_price = '';
    }
    if (!is_numeric($max_price) && $max_price !== '') {
        $max_price = '';
    }

    $keyword = isset($_GET['keyword']) ? trim(htmlspecialchars($_GET['keyword'])) : '';
    $category = isset($_GET['category']) ? trim(htmlspecialchars($_GET['category'])) : '';
    $sort = isset($_GET['sort']) && in_array($_GET['sort'], ['asc', 'desc']) ? $_GET['sort'] : '';
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
}
?> -->

 <header>
      <div class="header-middle">
      <div class="container">
          <div class="header-middle-left">
            <div class="header-logo">
              <a href="index.php">
                <img
                  src="./assets/img/logo.png"
                  alt=""
                  class="header-logo-img"
                />
              </a>
          </div>
          </div>
<div class="header-middle-center">
<form id="search-form" class="form-search" method="GET" action="index.php">
        <span class="search-btn" onclick="submitSearchForm(event)">
            <i class="fa-light fa-magnifying-glass"></i>
        </span>
        <input type="text" class="form-search-input" id="search-input" name="keyword" placeholder="Tìm kiếm món ăn..." value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
    </form>
</div>
        <button class="filter-btn" id="toggle-filter-btn" type="button">
            <i class="fa-light fa-filter-list"></i><span>Lọc</span>
        </button>
          <div class="header-middle-right">
            <ul class="header-middle-right-list">
              <li class="header-middle-right-item dropdown open">
                <i class="fa-light fa-user"></i>
                <div class="auth-container">
                  <span class="text-dndk">Đăng nhập / Đăng ký</span>
                  <span class="text-tk"
                    >Tài khoản <i class="fa-sharp fa-solid fa-caret-down"></i
                  ></span>
                </div>
                <ul class="header-middle-right-menu">
                  <li>
                  <a
                    class="dropdown-item"
                    href="dangnhap.php"
                    ><i class="fa-solid fa-right-to-bracket"></i>Đăng nhập</a
                  >
                  </li>
                  <li>
                  <a
                    class="dropdown-item"
                    href="dangky.php"
                    ><i class="fa-solid fa-user-plus"></i>Đăng kí</a
                  >
                  </li>
                </ul>
              </li>
              <a href="dangnhap.php" class="header-middle-right-item open" >
                <div class="cart-icon-menu">
                  <i class="fa-light fa-basket-shopping"></i>
                  <span class="count-product-cart">0</span>
                </div>
                <span>Giỏ hàng</span>
              </a>
            </ul>
        </div>
      </div>

      
      </div>
    </header>
    <nav class="header-bottom">
  <div class="container">
    <ul class="menu-list">
      <li class="menu-list-item"><a href="index.php" class="menu-link">Trang chủ</a></li>
      <li class="menu-list-item"><a href="index.php?Type=Món chay#scroll" class="menu-link">Món chay</a></li>
      <li class="menu-list-item"><a href="index.php?Type=Món mặn#scroll" class="menu-link">Món mặn</a></li>
      <li class="menu-list-item"><a href="index.php?Type=Món lẩu#scroll" class="menu-link">Món lẩu</a></li>
      <li class="menu-list-item"><a href="index.php?Type=Món ăn vặt#scroll" class="menu-link">Món ăn vặt</a></li>
      <li class="menu-list-item"><a href="index.php?Type=Món tráng miệng#scroll" class="menu-link">Món tráng miệng</a></li>
      <li class="menu-list-item"><a href="index.php?Type=Nước uống#scroll" class="menu-link">Nước uống</a></li>
      <li class="menu-list-item"><a href="index.php?Type=Hải sản#scroll" class="menu-link">Hải sản</a></li>
    </ul>
  </div>
</nav>

<div class="advanced-search" id="advanced-search">
    <form id="advanced-search-form" method="GET" action="index.php" class="container">
        <div class="advanced-search-category">
            <span>Phân loại</span>
            <select id="advanced-search-category-select" name="category">
                <option value="">Tất cả</option>
                <option value="món chay" <?php echo ($category == 'món chay') ? 'selected' : ''; ?>>Món chay</option>
                <option value="món mặn" <?php echo ($category == 'món mặn') ? 'selected' : ''; ?>>Món mặn</option>
                <option value="món lẩu" <?php echo ($category == 'món lẩu') ? 'selected' : ''; ?>>Món lẩu</option>
                <option value="món ăn vặt" <?php echo ($category == 'món ăn vặt') ? 'selected' : ''; ?>>Món ăn vặt</option>
                <option value="món tráng miệng" <?php echo ($category == 'món tráng miệng') ? 'selected' : ''; ?>>Món tráng miệng</option>
                <option value="nước uống" <?php echo ($category == 'nước uống') ? 'selected' : ''; ?>>Nước uống</option>
                <option value="hải sản" <?php echo ($category == 'hải sản') ? 'selected' : ''; ?>>Hải sản</option>
            </select>
        </div>
        <div class="advanced-search-price">
            <span>Giá từ</span>
            <input type="text" placeholder="tối thiểu" id="min-price" name="min_price" 
                   value="<?php echo $min_price !== '' ? number_format($min_price, 0, ',', '.') : ''; ?>">
            <span>đến</span>
            <input type="text" placeholder="tối đa" id="max-price" name="max_price" 
                   value="<?php echo $max_price !== '' ? number_format($max_price, 0, ',', '.') : ''; ?>">
            <button type="submit" id="advanced-search-price-btn">
                <i class="fa-light fa-magnifying-glass-dollar"></i>
            </button>
        </div>
        <div class="advanced-search-control">
            <button type="submit" name="sort" value="asc" title="Sắp xếp giá tăng dần">
                <i class="fa-regular fa-arrow-up-short-wide"></i>
            </button>
            <button type="submit" name="sort" value="desc" title="Sắp xếp giá giảm dần">
                <i class="fa-regular fa-arrow-down-wide-short"></i>
            </button>
            <button>
              <a href="index.php">
              <i class="fa-light fa-arrow-rotate-right"></i>
              </a>
            </button>
            <button type="button" onclick="closeSearchAdvanced()">
                <i class="fa-light fa-xmark"></i>
            </button>
        </div>
        <!-- Hidden input for keyword -->
        <input type="hidden" id="advanced-keyword" name="keyword" 
               value="<?php echo htmlspecialchars($keyword); ?>">
        <input type="hidden" name="page" value="<?php echo htmlspecialchars($page); ?>">
    </form>
</div>

<script>
function submitSearchForm(event) {
    event.preventDefault();
    const searchInput = document.getElementById('search-input').value;
    document.getElementById('advanced-keyword').value = searchInput;
    document.getElementById('search-form').submit();
}

document.getElementById('advanced-search-form').addEventListener('submit', function() {
    const searchInput = document.getElementById('search-input').value;
    document.getElementById('advanced-keyword').value = searchInput;
});

function formatPrice(input) {
    let value = input.value.replace(/\D/g, '');
    if (value) {
        value = parseInt(value).toLocaleString('vi-VN');
        input.value = value;
    }
}

document.getElementById('min-price').addEventListener('input', function() {
    formatPrice(this);
});

document.getElementById('max-price').addEventListener('input', function() {
    formatPrice(this);
});

function closeSearchAdvanced() {
    document.getElementById('advanced-search').style.display = 'none';
}
</script>

    <!-- End header top  -->