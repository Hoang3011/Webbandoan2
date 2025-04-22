 <!-- header top  -->
<!-- <?php
   session_start();
   ob_start();
?> -->

<style>
  a{
    color: #000;
  }
</style>

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
            <form id="search-form" class="form-search" onsubmit="event.preventDefault(); searchProducts();">
                <span class="search-btn" onclick="searchProducts()">
                    <i class="fa-light fa-magnifying-glass"></i>
                </span>
                <input type="text" class="form-search-input" id="search-input" placeholder="Tìm kiếm món ăn...">
                <button class="filter-btn" id="toggle-filter-btn">
                    <i class="fa-light fa-filter-list"></i><span>Lọc</span>
                </button>
            </form>
        </div>
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

    <div class="advanced-search" id="advanced-search" >
    <div class="container">
        <div class="advanced-search-category">
            <span>Phân loại</span>
            <select id="advanced-search-category-select">
                <option value="">Tất cả</option>
                <option value="món chay">Món chay</option>
                <option value="món mặn">Món mặn</option>
                <option value="món lẩu">Món lẩu</option>
                <option value="món ăn vặt">Món ăn vặt</option>
                <option value="món tráng miệng">Món tráng miệng</option>
                <option value="nước uống">Nước uống</option>
                <option value="hải sản">Hải sản</option>
                
            </select>
        </div>

        <div class="advanced-search-price">
            <span>Giá từ</span>
            <input type="number" placeholder="tối thiểu" id="min-price">
            <span>đến</span>
            <input type="number" placeholder="tối đa" id="max-price">
            <button type="button" id="advanced-search-price-btn">
                <i class="fa-light fa-magnifying-glass-dollar"></i> 
            </button>
        </div>

        <div class="advanced-search-control">
            <button id="sort-ascending" onclick="searchProducts(1)">
            <i class="fa-regular fa-arrow-up-short-wide"></i>
          </button>
          <button id="sort-descending" onclick="searchProducts(2)">
            <i class="fa-regular fa-arrow-down-wide-short"></i>
          </button>
          <button id="reset-search" onclick="searchProducts(0)">
            <i class="fa-light fa-arrow-rotate-right"></i>
          </button>
          <button onclick="closeSearchAdvanced()">
            <i class="fa-light fa-xmark"></i>
          </button>
        </div>
    </div>
</div>

    <!-- End header top  -->