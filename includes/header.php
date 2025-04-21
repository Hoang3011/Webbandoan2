 <!-- header top  -->
<?php
   session_start();
   ob_start();
?>
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
                    href="#"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    ><i class="fa-solid fa-right-to-bracket"></i>Đăng nhập</a
                  >
                  </li>
                  <li>
                  <a
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#exampleModal-2"
                    ><i class="fa-solid fa-user-plus"></i>Đăng kí</a
                  >
                  </li>
                </ul>
              </li>
              <li class="header-middle-right-item open" data-toggle="modal"  
              data-target="#cartModal">
                <div class="cart-icon-menu">
                  <i class="fa-light fa-basket-shopping"></i>
                  <span class="count-product-cart">0</span>
                </div>
                <span>Giỏ hàng</span>
              </li>
            </ul>
        </div>
      </div>

      <!-- Modal login -->

      <div
        class="modal fade modal-form"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="inner-title">Đăng nhập tài khoản</h5>
              <p class="inner-desc">
                Đăng nhập thành viên để mua hàng và nhận những ưu đãi đặc biệt
                từ chúng tôi
              </p>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"

              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post" onsubmit="dangNhap()">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                      <input
                        type="text"
                        id="sdt"
                        class="form-control"
                        placeholder="Nhập số điện thoại"
                        name="sdt"
                        required
                      />
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="mk">Mật khẩu</label>
                      <input
                        type="password"
                        id="mk"
                        class="form-control"
                        placeholder="Nhập mật khẩu"
                        name="password"
                        required
                      />
            </div>
        </div>
        <div class="col-12">
                    <button class="button" name="dangnhap"> Đăng nhập </button>
        </div>
    </div>
</form>
<?php 
include "connect.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['dangnhap'])) {
    $phonenumber = $_POST['sdt'];
    $password = $_POST['password'];

    // Sử dụng prepared statement để tránh SQL Injection
    $sql = "SELECT * FROM khachhang WHERE sodienthoai = ? AND matkhau = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $phonenumber, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc(); // Lấy dữ liệu khách hàng

        if ($row['trangthai'] === 'Active') {
            $_SESSION['mySession'] = $row['tenkh'];
            $_SESSION['makh'] = $row['makh'];

            header("Location: login.php");
            exit();
        } else if ($row['trangthai'] === 'Locked') {
            echo "Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.";
        } else {
            echo "Trạng thái tài khoản không hợp lệ.";
        }
    } else {
        echo "Sai mật khẩu hoặc số điện thoại!";
    }

    $stmt->close();
    $conn->close();
}
?>

            </div>
          </div>
        </div>
      </div>
      <!-- End Modal login -->

      <!-- Modal register -->

      <div
        class="modal fade modal-form"
        id="exampleModal-2"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="inner-title">Đăng ký tài khoản</h5>
              <p class="inner-desc">
                Đăng ký thành viên để mua hàng và nhận những ưu đãi đặc biệt từ
                chúng tôi
              </p>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post" onsubmit="dangKi()">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">Tên đầy đủ</label>
                      <input
                        type="text"
                        id="name"
                        class="form-control"
                        placeholder="VD: Thành Đại"
                        name="ten"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="sdt2">Số điện thoại</label>
                      <input
                        type="text"
                        id="sdt2"
                        class="form-control"
                        placeholder="Nhập số điện thoại"
                        name="sdt"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="dc">Địa chỉ</label>
                      <input
                        type="text"
                        id="dc"
                        class="form-control"
                        placeholder="Nhập địa chỉ"
                        name="diachi"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="mk2">Mật khẩu</label>
                      <input
                        type="password"
                        id="mk2"
                        class="form-control"
                        placeholder="Nhập mật khẩu"
                        name="password"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="nhapmk">Nhập lại Mật khẩu</label>
                      <input
                        type="password"
                        id="nhapmk"
                        class="form-control"
                        placeholder="Nhập lại mật khẩu"
                        name="password1"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="button" name="dangki">Đăng kí</button>
                  </div>
                </div>
              </form>
              <?php
              include "connect.php";
              if(isset($_POST['dangki'])){
               $tenkh  = $_POST['ten'];
               $sdtkh = $_POST['sdt'];
               $diachikh = $_POST['diachi'];
               $pass = $_POST['password'];
               $pass1 = $_POST['password1'];
               if($pass == $pass1){
                $sql = "INSERT INTO Khachhang(tenkh,matkhau,diachi,sodienthoai) VALUES(?,?,?,?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss",$tenkh,$pass,$diachikh,$sdtkh);
                if($stmt->execute()){
                  $_SESSION['ten'] = $tenkh;
                  $_SESSION['sdt'] = $sdtkh;
                  header ("location: login.php");
                  exit();
                }
                else {echo "đăng ký thất bại";}
               }
               else {
                    echo "Mật khẩu nhập lại không khớp!";
               }
              }
              ?>

            </div>
          </div>
        </div>
      </div>

      <!-- End Modal register -->

      <!-- Modal shopping -->

      <div
        class="modal fade right"
        id="cartModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="cartModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <div class="inner-shopping">
                <div class="inner-icon">
                  <i class="fa-solid fa-basket-shopping"></i>
                </div>
                <span class="inner-text-shopping">Giỏ hàng</span>
              </div>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="inner-icon">
                <i class="fa-solid fa-cart-xmark"></i>
              </div>
              <div class="inner-desc">
                Không có sản phẩm nào trong giỏ hàng của bạn
              </div>
            </div>
            <div class="modal-footer">
              <div class="inner-tong">
                <div class="inner-text-tong">Tổng tiền:</div>
                <div class="inner-gia-tong">0 ₫</div>
              </div>
              <div class="inner-nut">
                <button
                  type="button"
                  class="inner-tm"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <i class="fa-solid fa-plus"></i>Thêm món
                </button>
                <button class="inner-tt inner-tt-nologin">Thanh toán</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- End Modal shopping -->

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