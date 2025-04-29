<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/font-awesome-pro-v6-6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="admin/css/style.css" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/admin.css" />
    <title>Admin</title>
    <link href="./assets/img/logo.png" rel="icon" type="image/x-icon" />
  </head>
  <body>
    <?php
    include_once "./includes/headeradmin.php";
    ?>

    <style>

      .form-control {
        margin-left: 10px;
      }

      .form-control:disabled{
        margin-left: 20px;
      }

      .ml-30{
        margin-left: 30px;
      }

      .ml-15{
        margin-left: 15px;
      }
    </style>

    <!-- Adminorder -->
    <div class="admin-order">
      <div class="admin-control">
        <div class="admin-control-left">
          <select name="tinh-trang-user" id="tinh-trang-user">
            <option value="">Tất cả</option>
            <option value="Chưa xác nhận">Chưa xác nhận</option>
            <option value="Đã xác nhận">Đã xác nhận</option>
            <option value="Đã giao thành công">Đã giao thành công</option>
            <option value="Đã hủy đơn">Đã hủy đơn</option>
          </select>
        </div>
        <div class="admin-control-right">
          <form class="fillter-date">
            <div>
              <label for="time-start">Từ</label>
              <input
                type="date"
                class="form-control-date"
                id="time-start-user"
              />
            </div>
            <div>
              <label for="time-end">Đến</label>
              <input
                type="date"
                class="form-control-date"
                id="time-end-user"
              />
            </div>
          </form>  
            <div>
              <select id="province" class="form-control">
                <option value="">Chọn Tỉnh/Thành</option>
              </select>
            </div>
            <div>
              <select id="district" class="form-control ml-15" disabled>
                <option value="">Chọn Quận/Huyện</option>
              </select>
            </div>
            <button type="button" id="search-btn" class="reset-order ml-30"><i class="fa-light fa-magnifying-glass"></i></button>
            <a href="adminorder.php" class="reset-order"><i class="fa-light fa-arrow-rotate-right"></i></a>
        </div>
      </div>
      <!-- End Adminorder -->

      <!-- Show Admin Orders -->
<!-- Thay thế phần <div class="table"> trong adminorder.php -->
<div class="table">
  <table width="100%" id="order-table">
    <thead>
      <tr>
        <td>Mã đơn</td>
        <td>Khách hàng</td>
        <td>Ngày đặt</td>
        <td>Tổng tiền</td>
        <td>Trạng thái</td>
        <td>Thao tác</td>
      </tr>
    </thead>
    <tbody id="showOrder">
    <?php
include_once 'connect.php';

// Thiết lập phân trang
$limit = 10; // Số đơn hàng mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Đếm tổng số đơn hàng
$total_query = "SELECT COUNT(*) AS total FROM donhang";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_orders = $total_row['total'];
$total_pages = ceil($total_orders / $limit);

// Truy vấn với giới hạn và offset
$sql = "SELECT dh.madh, dh.makh, dh.ngaytao, dh.tongtien, dh.trangthai, kh.tenkh 
        FROM donhang dh 
        JOIN khachhang kh ON dh.makh = kh.makh 
        ORDER BY dh.ngaytao DESC 
        LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $madh = "DH" . $row['madh'];
        $ngaydat = date('d/m/Y', strtotime($row['ngaytao']));
        
        // CÁCH FORMAT TIỀN CHUẨN
        $tongtien = (int) $row['tongtien']; 
        $tongtien1 = number_format($tongtien, 0, ',', '.') . " ₫"; 

        $status_class = '';
        switch ($row['trangthai']) {
            case 'Chưa xác nhận':
                $status_class = 'status-no-complete';
                break;
            case 'Đã xác nhận':
                $status_class = 'status-middle-complete';
                break;
            case 'Đã giao thành công':
                $status_class = 'status-complete';
                break;
            case 'Đã hủy đơn':
                $status_class = 'status-destroy-complete';
                break;
        }
?>
<tr>
    <td><?= $madh; ?></td>
    <td><?= htmlspecialchars($row['tenkh']); ?></td>
    <td><?= $ngaydat; ?></td>
    <td><?= $tongtien1; ?></td>
    <td><span class="<?= $status_class; ?>"><?= $row['trangthai']; ?></span></td>
    <td class="control">
        <a href="adminchitiet.php?madh=<?= $row['madh']; ?>" class="btn-detail">
            <i class="fa-regular fa-eye"></i> Chi tiết
        </a>
    </td>
</tr>
<?php
    }
} else {
    echo "<tr><td colspan='6'>Không có đơn hàng nào</td></tr>";
}
mysqli_close($conn);
?>
    </tbody>
  </table>
</div>

<!-- Thêm phân trang -->
<div class="Pagination">
  <div class="container">
    <ul>
      <?php
      for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $page) ? 'trang-chinh' : '';
        echo '<li><a href="?page=' . $i . '" class="inner-trang ' . $active_class . '">' . $i . '</a></li>';
      }
      ?>
    </ul>
  </div>
</div>
    </div>
    <!-- End Admin Orders-->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="assets/js/admin.js"></script>
    <script>
      $(document).ready(function() {
        // Fetch provinces from API
        $.getJSON('https://provinces.open-api.vn/api/p/', function(data) {
          $.each(data, function(index, province) {
            $('#province').append(`<option value="${province.name}">${province.name}</option>`);
          });
        });

        // Fetch districts when a province is selected
        $('#province').change(function() {
          const provinceName = $(this).val();
          $('#district').prop('disabled', true).html('<option value="">Chọn Quận/Huyện</option>');
          if (provinceName) {
            $.getJSON(`https://provinces.open-api.vn/api/p/search/?q=${provinceName}`, function(provinceData) {
              if (provinceData.length > 0) {
                const provinceCode = provinceData[0].code;
                $.getJSON(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`, function(data) {
                  $.each(data.districts, function(index, district) {
                    $('#district').append(`<option value="${district.name}">${district.name}</option>`);
                  });
                  $('#district').prop('disabled', false);
                });
              }
            });
          }
        });

        // Search button click handler
        $('#search-btn').click(function() {
          const status = $('#tinh-trang-user').val();
          const orderId = ''; // No search input for order ID
          const startDate = $('#time-start-user').val();
          const endDate = $('#time-end-user').val();
          const province = $('#province').val();
          const district = $('#district').val();

          $.ajax({
            url: 'search_orders.php',
            type: 'POST',
            data: {
              status: status,
              orderId: orderId,
              startDate: startDate,
              endDate: endDate,
              province: province,
              district: district
            },
            success: function(response) {
              $('#order-table').fadeOut(300, function() {
                $('#showOrder').html(response);
                $('#order-table').fadeIn(300);
              });
            },
            error: function() {
              alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
            }
          });
        });
      });
    </script>
  </body>
</html>