<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title>Sidebar 09</title> -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="assets/font-awesome-pro-v6-6.2.0/css/all.min.css"
    />

    <link rel="stylesheet" href="admin/css/style.css" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/admin.css" />

    <title>Admin</title>
    <link href="./assets/img/logo.png" rel="icon" type="image/x-icon" />
  </head>

  <body>
  <?php
    include_once "./connect.php"; // Kết nối database
    include_once "./includes/headeradmin.php"; // Header admin

    // Lấy madh từ URL
    $madh = isset($_GET['madh']) ? intval($_GET['madh']) : 0;

    // Truy vấn chi tiết đơn hàng
    $sql = "
        SELECT 
            ctdh.mactdh, ctdh.masp, ctdh.soluong, ctdh.giabanle, 
            sp.Name AS ten_sanpham, sp.Image AS anh_sanpham,
            dh.ngaytao, dh.phuongthuc, dh.ghichu, dh.trangthai, dh.tongtien AS tongtien_dh,
            kh.tenkh, kh.sodienthoai, kh.diachi
        FROM chitietdonhang ctdh
        JOIN sanpham sp ON ctdh.masp = sp.ID
        JOIN donhang dh ON ctdh.madh = dh.madh
        JOIN khachhang kh ON dh.makh = kh.makh
        WHERE ctdh.madh = ?
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
      die("Lỗi prepare SQL: " . $conn->error);
  }
    $stmt->bind_param("i", $madh);
    $stmt->execute();
    $result = $stmt->get_result();

    $order_details = [];
    $total_items = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $order_details[] = $row;
            $total_items += $row['soluong'];
        }
    }
    $order_info = $order_details[0] ?? null; // Lấy thông tin đơn hàng từ dòng đầu tiên

    // Phí vận chuyển mặc định
    $phi_van_chuyen = 30;
    ?>
       <div class="admin-chitiet">
        <div class="order-chitiet">
            <div class="row">
                <div class="col-12">
                    <div class="inner-head">
                        <div class="inner-title">Chi tiết đơn hàng</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="order-chitietstart">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <?php if (!empty($order_details)): ?>
                                    <?php foreach ($order_details as $item): ?>
                                        <div class="inner-item">
                                            <div class="inner-info">
                                                <div class="inner-img">
                                                    <img src="<?php echo htmlspecialchars($item['anh_sanpham'] ?: 'assets/img/products/default.jpg'); ?>" alt="Product Image" />
                                                </div>
                                                <div class="inner-mota">
                                                    <div class="inner-ten"><?php echo htmlspecialchars($item['ten_sanpham'] ?: 'Sản phẩm không xác định'); ?></div>
                                                    <div class="inner-sl">SL: <?php echo intval($item['soluong']); ?></div>
                                                </div>
                                            </div>
                                            <div class="inner-gia"><?php echo $item['giabanle']; ?>.000 ₫</div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Không tìm thấy chi tiết đơn hàng.</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <?php if ($order_info): ?>
                                    <div class="inner-pt">
                                        <div class="inner-cachthuc"><i class="fa-regular fa-calendar-days"></i> Ngày đặt hàng</div>
                                        <div class="inner-ketqua"><?php echo date('d/m/Y', strtotime($order_info['ngaytao'])); ?></div>
                                    </div>
                                    <div class="inner-pt">
                                        <div class="inner-cachthuc"><i class="fa-regular fa-credit-card"></i> PT thanh toán</div>
                                        <div class="inner-ketqua"><?php echo htmlspecialchars($order_info['phuongthuc'] ?: 'Không xác định'); ?></div>
                                    </div>
                                    <div class="inner-pt">
                                        <div class="inner-cachthuc"><i class="fa-solid fa-person"></i> Người nhận</div>
                                        <div class="inner-ketqua"><?php echo htmlspecialchars($order_info['tenkh'] ?: 'Không xác định'); ?></div>
                                    </div>
                                    <div class="inner-pt">
                                        <div class="inner-cachthuc"><i class="fa-solid fa-phone"></i> Số điện thoại</div>
                                        <div class="inner-ketqua"><?php echo htmlspecialchars($order_info['sodienthoai'] ?: 'Không xác định'); ?></div>
                                    </div>
                                    <div class="inner-diachi">
                                        <div class="inner-cachthuc"><i class="fa-solid fa-location-dot"></i> Địa chỉ nhận</div>
                                        <p class="inner-desc"><?php echo htmlspecialchars($order_info['diachi'] ?: 'Không xác định'); ?></p>
                                    </div>
                                    <div class="inner-diachi">
                                        <div class="inner-cachthuc"><i class="fa-light fa-note-sticky"></i> Ghi chú</div>
                                        <p class="inner-desc"><?php echo htmlspecialchars($order_info['ghichu'] ?: ''); ?></p>
                                    </div>
                                <?php else: ?>
                                    <p>Không tìm thấy thông tin đơn hàng.</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-12">
                                <div class="order-chitietend">
                                    <?php if ($order_info): ?>
                                        <div class="inner-tien">
                                            <div class="inner-th">Tiền hàng <span><?php echo $total_items; ?> món</span></div>
                                            <div class="inner-st"><?php echo $order_info['tongtien_dh'] ; ?>.000 ₫</div>
                                        </div>
                                        <div class="inner-vanchuyen">
                                            <span class="inner-vc1">Vận chuyển</span>
                                            <span class="inner-vc2"><?php echo $phi_van_chuyen ; ?>.000 ₫</span>
                                        </div>
                                        <div class="inner-tonggia">
                                            <div class="inner-giaca">
                                                <div class="inner-chu">Thành tiền</div>
                                                <div class="inner-so"><?php echo $order_info['tongtien_dh'] + $phi_van_chuyen ; ?>.000 ₫</div>
                                            </div>
                                            <div class="inner-select">
                                          <label for="select">Trạng thái</label>
                                          <select name="trangthai" id="select">
                                              <?php
                                              $currentStatus = $order_info['trangthai'];

                                              if ($currentStatus == 'Chưa xác nhận') {
                                                  echo '<option value="Chưa xác nhận" selected>Chưa xác nhận</option>';
                                                  echo '<option value="Đã xác nhận">Đã xác nhận</option>';
                                              } elseif ($currentStatus == 'Đã xác nhận') {
                                                  echo '<option value="Đã xác nhận" selected>Đã xác nhận</option>';
                                                  echo '<option value="Đã giao thành công">Đã giao thành công</option>';
                                                  echo '<option value="Đã hủy đơn">Đã hủy đơn</option>';
                                              } elseif ($currentStatus == 'Đã giao thành công') {
                                                  echo '<option value="Đã giao thành công" selected disabled>Đã giao thành công</option>';
                                              } elseif ($currentStatus == 'Đã hủy đơn') {
                                                  echo '<option value="Đã hủy đơn" selected disabled>Đã hủy đơn</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>

                                        </div>
                                        <div class="inner-capnhat">
                                            <button onclick="updateOrder(<?php echo $madh; ?>)" class="inner-nut">
                                                <i class="fa-regular fa-floppy-disk"></i> Cập nhật trạng thái
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <p>Không thể hiển thị thông tin tổng kết đơn hàng.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="assets/js/admin.js"></script>
    <script>
        function updateOrder(madh) {
            const trangthai = document.getElementById('select').value;
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: { madh: madh, trangthai: trangthai },
                success: function(response) {
                    if (response === 'success') {
                        window.location.href = 'adminorder.php';
                    } else {
                        alert('Cập nhật trạng thái thất bại. Vui lòng thử lại.');
                    }
                },
                error: function() {
                    alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                }
            });
        }
    </script>
  </body>
</html>
<?php
$stmt->close();
$conn->close();
?>