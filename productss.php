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
  include_once "includes/headerlogin.php";
  ?>


    <!-- products -->

    <div class="products">
      <div class="container">
        <form action="">
          <div class="row">
            <div class="col-xl-12">
              <div class="inner-title">Quản lý đơn hàng của bạn</div>
              <div class="inner-desc">
                Xem chi tiết, trạng thái của những đơn hàng đã đặt.
              </div>
            </div>
          </div>
          <div class="inner-menu">
            <table class="table table-bordered">
  <tr>
    <th>Đơn hàng</th>
    <th>Ngày</th>
    <th>Địa chỉ</th>
    <th>Giá trị đơn hàng</th>
    <th>PT thanh toán</th>
    <th>Trạng thái</th>
  </tr>
  <?php
  include "connect.php";
  if (isset($_SESSION['makh'])) {
      $makh = $_SESSION['makh'];
      $sql = "SELECT madh, ngaytao, diachi, tongtien, phuongthuc ,trangthai 
              FROM donhang 
              WHERE makh = ? 
              ORDER BY ngaytao DESC";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $makh);
      $stmt->execute();
      $result = $stmt->get_result();
  
      while ($row = $result->fetch_assoc()) {
          echo '<tr>
                  <td><a class="active" href="chitiet.php?madh=' . $row['madh'] . '">DH' . $row['madh'] . '</a></td>
                  <td>' . date("d-m-Y", strtotime($row['ngaytao'])) . '</td>
                  <td>' . htmlspecialchars($row['diachi']) . '</td>
                  <td>' . number_format($row['tongtien'], 0, ',', '.') . '.000₫</td>
                  <td>' . htmlspecialchars($row['phuongthuc']) . '</td>
                  <td>' . htmlspecialchars($row['trangthai']) . '</td>
                </tr>';
      }
  } else {
      echo '<tr><td colspan="6">Bạn cần đăng nhập để xem đơn hàng.</td></tr>';
  }
  ?>
</table>

          </div>
        </form>
      </div>
    </div>

    <!-- End products -->

       <?php
  include_once "includes/footer.php";
  ?>


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
