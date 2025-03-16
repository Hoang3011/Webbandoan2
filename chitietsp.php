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
  <?php
    include_once "includes/header.php"; 
    ?>
    <!-- ChiTietSP -->
    <?php
        include "connect.php"; // Kết nối đến database

        // Kiểm tra xem có ID sản phẩm trong URL không
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Lấy ID từ URL và đảm bảo là số nguyên

            // Truy vấn sản phẩm theo ID
            $sql = "SELECT * FROM sanpham WHERE ID = $id";
            $result = mysqli_query($conn, $sql);

            // Kiểm tra sản phẩm có tồn tại không
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
            } else {
                echo "<h2>Không tìm thấy sản phẩm!</h2>";
                exit(); // Dừng trang nếu không có sản phẩm
            }
        } else {
            echo "<h2>Không có sản phẩm nào được chọn!</h2>";
            exit(); // Dừng trang nếu không có ID
        }
?>

    <div class="chitietSP">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 col-lg-9">
            <div class="row">
              <div class="col-xl-5 col-lg-5">
                <div class="inner-image">
                  <div class="inner-img">
                    <img src="<?php echo $row['Image']?>" />
                  </div>
                </div>
              </div>
              <div class="col-xl-7 col-lg-7">
                <div class="inner-content">
                  <div class="inner-ten"><?php echo $row['Name']?></div>
                  <div class="inner-tt">
                    Trạng thái:
                    <span class="inner-conhang"
                      ><i class="fa-solid fa-check"></i>Còn món</span
                    >
                  </div>
                  <div class="inner-gia"><?php echo $row['Price'] ?>.000 ₫</div>
                  <div class="inner-desc">
                    <?php echo $row['Describtion'] ?>
                  </div>
                </div>

                <div class="inner-add">
                  <div class="inner-sl">Số lượng:</div>
                  <div class="inner-tanggiam">
                    <span id="giam" class="inner-tru">-</span>
                    <input
                      id="tanggiam"
                      type="text"
                      value="1"
                      class="inner-so"
                    />
                    <span id="tang" class="inner-cong">+</span>
                  </div>
                  <button type="button" onclick="notLogin()" class="inner-nut">
                    Thêm vào giỏ hàng
                  </button>
                </div>
              </div>
              <div class="col-xl-12">
                <div class="inner-thongtin">
                  <div class="inner-nut">
                    <button class="inner-mt inner-mt-active">Mô tả</button>
                    <button class="inner-mt">Đánh giá</button>
                  </div>
                  <div class="inner-mota">
                    <div class="inner-nd">
                      <h2 class="inner-title">1. NGUYÊN LIỆU</h2>
                      <ul>
                        <li>Xương bò (xương ống, đuôi, sườn)</li>
                        <li>Gừng, hành tím</li>
                        <li>Quế, hạt mùi, thảo quả, đinh hương, hồi, tiêu</li>
                        <li>Muối, đường phèn, nước mắm</li>
                        <li>Mía lau (tuỳ chọn)</li>
                        <li>Bánh phở tươi</li>
                        <li>Thịt bò (thăn, gầu, bắp, tái, nạm, gân)</li>
                        <li>Hành lá, ngò rí</li>
                        <li>Chanh, ớt</li>
                        <li>Bánh quẩy (tuỳ chọn)</li>
                        <li>Tương ớt, tương đen, dầu hào (tuỳ chọn)</li>
                      </ul>
                    </div>
                    <div class="inner-nd">
                      <h2 class="inner-title">2. HƯƠNG VỊ</h2>
                      <p class="inner-desc">
                        Phở là một món ăn đậm đà hương vị, hấp dẫn ngay từ lần
                        thử đầu tiên. Nước dùng trong vắt, ngọt tự nhiên từ
                        xương bò hầm lâu, hòa quyện với các gia vị đặc trưng như
                        quế, hồi, thảo quả, tạo nên một hương vị ấm áp, thanh
                        thoát nhưng đầy lôi cuốn. Khi thưởng thức, bạn sẽ cảm
                        nhận được độ mềm mại của từng sợi bánh phở tươi, kết hợp
                        hoàn hảo với thịt bò mềm, ngọt, có thể là tái, nạm hay
                        gầu tùy khẩu vị. Một ít hành lá, ngò rí, và lát chanh
                        tươi giúp làm nổi bật hương vị, trong khi một chút ớt
                        cay nồng thêm phần kích thích. Món phở không chỉ là bữa
                        ăn, mà là một trải nghiệm đầy cảm xúc, từ vị ngọt thanh
                        của nước dùng đến sự hòa quyện hoàn hảo giữa các nguyên
                        liệu tươi ngon.
                      </p>
                    </div>
                    <div class="inner-nd">
                      <h2 class="inner-title">3. DINH DƯỠNG</h2>
                      <ul>
                        <li>Năng lượng (calo): Khoảng 350-450 kcal/bát.</li>
                        <li>
                          Chất đạm (protein): 20-30 gram, chủ yếu từ thịt bò.
                        </li>
                        <li>
                          Chất béo: 10-15 gram, tùy thuộc vào phần thịt bò (thịt
                          nạm, gầu, hoặc tái).
                        </li>
                        <li>
                          Carbohydrate: 40-50 gram từ bánh phở (tinh bột).
                        </li>
                        <li>
                          Chất xơ: Khoảng 1-2 gram từ rau thơm và hành tây.
                        </li>
                        <li>
                          Vitamin và khoáng chất: Phở bò cung cấp một số vitamin
                          A (từ rau), vitamin C (từ chanh và rau thơm), canxi,
                          sắt (từ thịt bò và gia vị).
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3">
            <div class="inner-danhmuc">
              <div class="inner-dm">
                <div class="inner-hinh">
                  <img src="assets/img/service_1.webp" />
                </div>
                <div class="inner-chu">GIAO HÀNG NHANH</div>
              </div>
              <div class="inner-dm">
                <div class="inner-hinh">
                  <img src="assets/img/service_2.png" />
                </div>
                <div class="inner-chu">HOÀN TIỀN NẾU KHÔNG NGON</div>
              </div>
              <div class="inner-dm">
                <div class="inner-hinh">
                  <img src="assets/img/service_3.webp" />
                </div>
                <div class="inner-chu">SẢN PHẨM AN TOÀN</div>
              </div>
              <div class="inner-dm">
                <div class="inner-hinh">
                  <img src="assets/img/service_4.webp" />
                </div>
                <div class="inner-chu">HỖ TRỢ 24/7</div>
              </div>
            </div>
            <?php
// Kết nối database
include "connect.php";

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn lấy 4 món ăn nổi bật ngẫu nhiên
$sql = "SELECT ID, Name, Image, Price FROM sanpham ORDER BY RAND() LIMIT 4";
$result = $conn->query($sql);
$result = $conn->query($sql);

if (!$result) {
    die("Lỗi truy vấn SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<div class='inner-noibat'>";
    echo "<div class='inner-nb'>SẢN PHẨM NỔI BẬT</div>";
    echo "<div class='inner-sp'>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<div class='inner-item'>";
        echo "<a href='chitietsp.php?id=" . $row["ID"] . "' class='inner-anh'>";
        echo "<img src='" . $row["Image"] . "' alt='" . $row["Name"] . "'>";
        echo "</a>";
        echo "<div class='inner-mota'>";
        echo "<div class='inner-ten'>" . $row["Name"] . "</div>";
        echo "<div class='inner-gia'>" . number_format($row["Price"]) . ".000₫</div>";
        echo "</div>";
        echo "</div>";
    }
    
    echo "</div></div>";
} else {
    echo "<p>Không có món ăn nổi bật nào.</p>";
}

// Đóng kết nối database
$conn->close();
?>


          </div>
        </div>
      </div>
    </div>

    <!-- End ChiTietSP -->

    <!-- End SanPham -->

    <div class="SanPham">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="inner-head">
              <div class="inner-title">Sản phẩm liên quan</div>
              <p class="inner-desc">
                Có phải bạn đang tìm những sản phẩm dưới đây
              </p>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="inner-item">
              <a href="chitietsp.html" class="inner-img">
                <img src="assets/img/products/banhmi.webp" />
              </a>
              <div class="inner-info">
                <div class="inner-ten">Bánh mì</div>
                <div class="inner-gia">20.000 ₫</div>
                <a href="chitietsp.html" class="inner-muahang">
                  <i class="fa-solid fa-cart-plus"></i> ĐẶT MÓN
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="inner-item">
              <a href="chitietsp.html" class="inner-img">
                <img src="assets/img/products/buncha.jpg" />
              </a>
              <div class="inner-info">
                <div class="inner-ten">Bún chả Hà Nội</div>
                <div class="inner-gia">50.000 ₫</div>
                <a href="chitietsp.html" class="inner-muahang">
                  <i class="fa-solid fa-cart-plus"></i> ĐẶT MÓN
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="inner-item">
              <a href="chitietsp.html" class="inner-img">
                <img src="assets/img/products/caolau.jpg" />
              </a>
              <div class="inner-info">
                <div class="inner-ten">Cao lầu</div>
                <div class="inner-gia">40.000 ₫</div>
                <a href="chitietsp.html" class="inner-muahang">
                  <i class="fa-solid fa-cart-plus"></i> ĐẶT MÓN
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="inner-item">
              <a href="chitietsp.html" class="inner-img">
                <img src="assets/img/products/goicuon.jpg" />
              </a>
              <div class="inner-info">
                <div class="inner-ten">Gỏi cuốn</div>
                <div class="inner-gia">30.000 ₫</div>
                <a href="chitietsp.html" class="inner-muahang">
                  <i class="fa-solid fa-cart-plus"></i> ĐẶT MÓN
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End SanPham-->

    <!-- Footer-top -->

    <div class="Footer-top">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-12">
            <div class="inner-logo">
              <img src="assets/img/logo.png" alt="logo" />
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="inner-text">
              <div class="inner-chu1">Đăng ký nhận tin</div>
              <div class="inner-chu2">Nhận thông tin mới nhất từ chúng tôi</div>
            </div>
          </div>
          <div class="col-xl-5 col-lg-5 col-md-6">
            <form action="" class="inner-form">
              <input type="text" placeholder="Nhập email của bạn" />
              <button class="inner-sub">
                ĐĂNG KÝ <i class="fa-solid fa-arrow-right"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- End Footer-top -->

    <!-- Footer-middle -->

    <div class="Footer-middle">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="inner-text">Về chúng tôi</div>
            <p class="inner-desc">
              Đặc Sản 3 Miền là thương hiệu được thành lập vào năm 2023 với tiêu
              chí đặt chất lượng sản phẩm lên hàng đầu.
            </p>
            <div class="inner-icon">
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-twitter"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="inner-text">liên kết</div>
            <ul>
              <li>
                <a href="#"
                  ><i class="fa-solid fa-arrow-right"></i>Về chúng tôi</a
                >
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-arrow-right"></i>Thực đơn</a>
              </li>
              <li>
                <a href="#"
                  ><i class="fa-solid fa-arrow-right"></i>Điều khoản</a
                >
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-arrow-right"></i>Liên Hệ</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-arrow-right"></i>Tin tức</a>
              </li>
            </ul>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="inner-text">thực đơn</div>
            <ul class="inner-menu">
              <li>
                <a href="#"><i class="fa-solid fa-arrow-right"></i>Điểm tâm</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-arrow-right"></i>Món chay</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-arrow-right"></i>Món mặn</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-arrow-right"></i>Nước uống</a>
              </li>
              <li>
                <a href="#"
                  ><i class="fa-solid fa-arrow-right"></i>Tráng miệng</a
                >
              </li>
            </ul>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="inner-text">liên hệ</div>
            <div class="inner-contact">
              <div class="inner-icon">
                <i class="fa-solid fa-location-dot"></i>
              </div>
              <div class="inner-diachi">
                <div class="inner-chu1">40/15 Tô Hiệu, P. Tân Thới Hòa</div>
                <div class="inner-chu2">Quận Tân Phú, TP Hồ Chí Minh</div>
              </div>
            </div>
            <div class="inner-contact">
              <div class="inner-icon">
                <i class="fa-solid fa-phone"></i>
              </div>
              <div class="inner-diachi">
                <div class="inner-chu1">0123 456 789</div>
                <div class="inner-chu2">0987 654 321</div>
              </div>
            </div>
            <div class="inner-contact">
              <div class="inner-icon">
                <i class="fa-regular fa-envelope"></i>
              </div>
              <div class="inner-diachi">
                <div class="inner-chu1">hđkn@gmail.com</div>
                <div class="inner-chu2">gacon@domain.com</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End Footer-middle -->

    <!-- Footer-bottom -->

    <div class="Footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="inner-end">
              Copyright 2023 ĐS3M. All Rights Reserved.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End Footer-bottom -->

    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>

    <script src="assets/js/main.js"></script>
  </body>
</html>
