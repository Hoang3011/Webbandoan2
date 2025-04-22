<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/font-awesome-pro-v6-6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="admin/css/style.css" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/admin.css" />
    <title>Chi Tiết Hóa Đơn</title>
    <link href="./assets/img/logo.png" rel="icon" type="image/x-icon" />
  </head>
  <body>
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="custom-menu">
          <button type="button" id="sidebarCollapse" class="btn btn-primary"></button>
        </div>
        <div class="img bg-wrap text-center py-4">
          <div class="user-logo">
            <div class="inner-logo">
              <img src="assets/img/logo.png" alt="logo" />
            </div>
          </div>
        </div>
        <ul class="list-unstyled components mb-5">
          <li>
            <a href="admin.php"><i class="fa-light fa-house"></i> Trang tổng quan</a>
          </li>
          <li>
            <a href="adminproduct.php"><i class="fa-light fa-pot-food"></i> Sản phẩm</a>
          </li>
          <li>
            <a href="admincustomer.php"><i class="fa-light fa-users"></i> Khách hàng</a>
          </li>
          <li>
            <a href="adminorder.php"><i class="fa-light fa-basket-shopping"></i> Đơn hàng</a>
          </li>
          <li class="active">
            <a href="adminstatistical.php"><i class="fa-light fa-chart-simple"></i> Thống kê</a>
          </li>
        </ul>

                <ul class="sidebar-list">
          <li class="sidebar-list-item user-logout">
            <a href="login.php" class="sidebar-link">
              <div class="sidebar-icon"><i class="fa-thin fa-circle-chevron-left"></i></div>
              <div class="hidden-sidebar">Trang chủ</div>
            </a>
          </li>
          <li class="sidebar-list-item user-logout">
            <a href="#" class="sidebar-link">
              <div class="sidebar-icon"><i class="fa-light fa-circle-user"></i></div>
              <div class="hidden-sidebar" id="name-acc">Lữ Học Nhân</div>
            </a>
          </li>
          <li class="sidebar-list-item user-logout">
            <a href="index.php" class="sidebar-link" id="logout-acc">
              <div class="sidebar-icon"><i class="fa-light fa-arrow-right-from-bracket"></i></div>
              <div class="hidden-sidebar">Đăng xuất</div>
            </a>
          </li>
        </ul>
      </nav>

      <!-- admin-hoadon -->
      <div class="admin-hoadon">
        <div class="hoadon">
          <div class="inner-head">
            <div class="inner-title">Chi tiết hóa đơn</div>
          </div>
          <div class="container" id="order-content">
            <!-- Order details will be populated dynamically -->
          </div>
        </div>
      </div>
    </div>

    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="assets/js/admin.js"></script>
    <script>
      // Sample data (matching adminthongkechitiet.php)
      const orders = [
        {
          customerId: 1,
          customerName: "Nguyễn Văn A",
          orderId: "DH1",
          date: "2024-11-20",
          paymentStatus: "Đã thanh toán",
          shippingStatus: "Đã giao hàng",
          address: "273 An Dương Vương, Phường 3, Quận 5, TP Hồ Chí Minh",
          phone: "0909098386",
          paymentMethod: "Thanh toán khi giao hàng",
          note: "Không có ghi chú",
          shippingCost: 30000,
          items: [
            { product: "Bánh Mì", quantity: 1, price: 20000, image: "assets/img/products/banhmi.webp" },
            { product: "Bún bò Huế", quantity: 1, price: 50000, image: "assets/img/products/bunbohue.jpg" }
          ]
        },
        {
          customerId: 1,
          customerName: "Nguyễn Văn A",
          orderId: "DH2",
          date: "2024-11-21",
          paymentStatus: "Chưa thanh toán",
          shippingStatus: "Đang xử lý",
          address: "273 An Dương Vương, Phường 3, Quận 5, TP Hồ Chí Minh",
          phone: "0909098386",
          paymentMethod: "Chuyển khoản",
          note: "Giao nhanh",
          shippingCost: 25000,
          items: [
            { product: "Phở Bò", quantity: 5, price: 50000, image: "assets/img/products/phobo.jpg" }
          ]
        },
        {
          customerId: 2,
          customerName: "Trần Thị B",
          orderId: "DH3",
          date: "2024-11-22",
          paymentStatus: "Đã thanh toán",
          shippingStatus: "Đã giao hàng",
          address: "123 Lê Lợi, Quận 1, TP Hồ Chí Minh",
          phone: "0912345678",
          paymentMethod: "Thanh toán khi giao hàng",
          note: "",
          shippingCost: 30000,
          items: [
            { product: "Bún Bò Huế", quantity: 8, price: 50000, image: "assets/img/products/bunbohue.jpg" }
          ]
        },
        {
          customerId: 3,
          customerName: "Lê Văn C",
          orderId: "DH4",
          date: "2024-11-23",
          paymentStatus: "Đã thanh toán",
          shippingStatus: "Đã giao hàng",
          address: "456 Nguyễn Huệ, Quận 1, TP Hồ Chí Minh",
          phone: "0923456789",
          paymentMethod: "Thanh toán khi giao hàng",
          note: "Gọi trước khi giao",
          shippingCost: 20000,
          items: [
            { product: "Mì Quảng", quantity: 6, price: 40000, image: "assets/img/products/miquang.jpg" }
          ]
        },
        {
          customerId: 4,
          customerName: "Phạm Thị D",
          orderId: "DH5",
          date: "2024-11-24",
          paymentStatus: "Chưa thanh toán",
          shippingStatus: "Đang xử lý",
          address: "789 Hai Bà Trưng, Quận 3, TP Hồ Chí Minh",
          phone: "0934567890",
          paymentMethod: "Chuyển khoản",
          note: "",
          shippingCost: 35000,
          items: [
            { product: "Bánh bột lọc", quantity: 20, price: 30000, image: "assets/img/products/banhbotloc.jpg" }
          ]
        },
        {
          customerId: 5,
          customerName: "Hoàng Văn E",
          orderId: "DH6",
          date: "2024-11-25",
          paymentStatus: "Đã thanh toán",
          shippingStatus: "Đã giao hàng",
          address: "101 Võ Văn Tần, Quận 3, TP Hồ Chí Minh",
          phone: "0945678901",
          paymentMethod: "Thanh toán khi giao hàng",
          note: "Giao buổi sáng",
          shippingCost: 25000,
          items: [
            { product: "Chả cá", quantity: 4, price: 40000, image: "assets/img/products/chaca.jpg" }
          ]
        },
        {
          customerId: 2,
          customerName: "Trần Thị B",
          orderId: "DH7",
          date: "2024-11-26",
          paymentStatus: "Đã thanh toán",
          shippingStatus: "Đã giao hàng",
          address: "123 Lê Lợi, Quận 1, TP Hồ Chí Minh",
          phone: "0912345678",
          paymentMethod: "Thanh toán khi giao hàng",
          note: "Không có ghi chú",
          shippingCost: 30000,
          items: [
            { product: "Gỏi cuốn", quantity: 15, price: 30000, image: "assets/img/products/goicuon.jpg" }
          ]
        }
      ];

      // Get orderId from URL
      const urlParams = new URLSearchParams(window.location.search);
      const orderId = urlParams.get("orderId");

      // Find the order
      const order = orders.find(o => o.orderId === orderId);

      // Get the order content container
      const contentContainer = document.getElementById("order-content");

      if (order) {
        // Format date to DD/MM/YYYY
        const dateParts = order.date.split('-');
        const formattedDate = `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;

        // Calculate totals
        const itemCount = order.items.reduce((sum, item) => sum + item.quantity, 0);
        const subtotal = order.items.reduce((sum, item) => sum + item.price * item.quantity, 0);
        const total = subtotal + order.shippingCost;

        // Generate items HTML
        let itemsHtml = '';
        order.items.forEach(item => {
          itemsHtml += `
            <div class="inner-item">
              <div class="inner-info">
                <div class="inner-img">
                  <img src="${item.image}" width="80px" height="80px" />
                </div>
                <div class="inner-chu">
                  <div class="inner-ten">${item.product}</div>
                  <div class="inner-sl">x${item.quantity}</div>
                </div>
              </div>
              <div class="inner-gia">${(item.price * item.quantity).toLocaleString()} ₫</div>
            </div>
          `;
        });

        // Populate order details
        contentContainer.innerHTML = `
          <div class="inner-chitiet">
            <div class="inner-tt">Chi tiết đơn hàng ${order.orderId}</div>
            <div class="inner-vc">Ngày đặt hàng: ${formattedDate}</div>
          </div>
          <div class="inner-trangthai">
            <div class="inner-ct">Trạng thái thanh toán: <i>${order.paymentStatus}</i></div>
            <div class="inner-ngay">Trạng thái vận chuyển: <i>${order.shippingStatus}</i></div>
          </div>
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="inner-diachi">
                <div class="inner-ten">ĐỊA CHỈ GIAO HÀNG</div>
                <div class="inner-gth">
                  <div class="inner-ten">${order.customerName.toUpperCase()}</div>
                  <div class="inner-dc">Địa chỉ: ${order.address}</div>
                  <div class="inner-sdt">Số điện thoại: ${order.phone}</div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="inner-diachi">
                <div class="inner-ten">THANH TOÁN</div>
                <div class="inner-gth">
                  <div class="inner-tt">${order.paymentMethod}</div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="inner-diachi">
                <div class="inner-ten">GHI CHÚ</div>
                <div class="inner-gth">
                  <div class="inner-ghichu">${order.note || "Không có ghi chú"}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="inner-menu">
            ${itemsHtml}
            <div class="inner-tonggia">
              <div class="inner-tien">
                <div class="inner-th">Tiền hàng <span>${itemCount} món</span></div>
                <div class="inner-st">${subtotal.toLocaleString()} ₫</div>
              </div>
              <div class="inner-vanchuyen">
                <span class="inner-vc1">Vận chuyển</span>
                <span class="inner-vc2">${order.shippingCost.toLocaleString()} ₫</span>
              </div>
              <div class="inner-total">
                <span class="inner-tong1">Tổng tiền:</span>
                <span class="inner-tong2">${total.toLocaleString()} ₫</span>
              </div>
            </div>
          </div>
        `;

        // Update back link
        document.getElementById("back-link").href = `adminthongkechitiet.php?customerId=${order.customerId}`;
      } else {
        // Handle case where order is not found
        contentContainer.innerHTML = `<p>Không tìm thấy hóa đơn.</p>`;
        document.getElementById("back-link").href = `adminthongkechitiet.php?customerId=1`;
      }
    </script>
  </body>
</html>