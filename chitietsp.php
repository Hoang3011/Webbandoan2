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
                  <div class="inner-gia"><?= number_format($row['Price'], 0, ',', '.'); ?>₫</div>
                  <div class="inner-desc">
                    <?php echo $row['Describtion'] ?>
                  </div>
                </div>

                <div class="inner-add">
                  <div class="inner-sl">Số lượng:</div>
                   <div class="inner-tanggiam">
                    <span id="giam" onclick="giamsoluong()" class="inner-tru">-</span>
                    <input
                      id="tanggiam"
                      type="text"
                      value="1"
                      class="inner-so"
                      name="soluong"
                    />
                    <span id="tang" onclick="tangsoluong()" class="inner-cong">+</span>
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
                  </div>
                  <div class="inner-mota">
                    <div class="inner-nd">
                    <?php echo $row['Describtion'] ?>
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
        echo "<div class='inner-gia'>" . number_format($row["Price"], 0, ',', '.') . " ₫</div>";
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
          <?php
// Kết nối đến database
include "connect.php";

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy 4 sản phẩm ngẫu nhiên
$sql = "SELECT * FROM sanpham ORDER BY RAND() LIMIT 4";
$result = $conn->query($sql);

// Hiển thị sản phẩm
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="inner-item">
              <a href="chitietsp.php?id='.$row['ID'].'" class="inner-img">
                <img src="'.$row['Image'].'" />
              </a>
              <div class="inner-info">
                <div class="inner-ten">'.$row['Name'].'</div>
                <div class="inner-gia">'.number_format($row['Price'], 0, ',', '.').' ₫</div>
                <a href="chitietsp.php?id='.$row['ID'].'" class="inner-muahang">
                  <i class="fa-solid fa-cart-plus"></i> ĐẶT MÓN
                </a>
              </div>
            </div>
        </div>';
    }
} else {
    echo "Không có sản phẩm nào!";
}

$conn->close();
?>

        </div>
      </div>
    </div>

    <!-- End SanPham-->
<?php
include_once "includes/footer.php";
?>
<script>
   function tangsoluong() {
    let input = document.getElementById("tanggiam");
    input.value = parseInt(input.value) + 1;
}
function giamsoluong() {
    let input = document.getElementById("tanggiam");
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>

</html>