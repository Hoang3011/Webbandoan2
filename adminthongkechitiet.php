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
    <title>Chi Tiết Đơn Hàng Khách Hàng</title>
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

    <div class="adminthongkechitiet">
      <div class="admin-control">
        <div class="admin-control-center">
          <form action="" class="form-search">
            <span class="search-btn" onclick="thongKe()"><i class="fa-light fa-magnifying-glass"></i></span>
            <input id="form-search-tk" type="text" class="form-search-input" placeholder="Tìm kiếm hóa đơn..." />
          </form>
        </div>
        <div class="admin-control-right">
          <form action="" class="fillter-date">
            <div>
              <label for="time-start">Từ</label>
              <input type="date" class="form-control-date" id="time-start-tk" onchange="thongKe()" />
            </div>
            <div>
              <label for="time-end">Đến</label>
              <input type="date" class="form-control-date" id="time-end-tk" onchange="thongKe()" />
            </div>
          </form>
          <button class="reset-order" onclick="thongKe(1)">
            <i class="fa-regular fa-arrow-up-short-wide"></i>
          </button>
          <button class="reset-order" onclick="thongKe(2)">
            <i class="fa-regular fa-arrow-down-wide-short"></i>
          </button>
          <a href="adminthongkechitiet.php" class="reset-order">
            <i class="fa-light fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>

      <div class="table">
        <table width="100%">
          <thead>
            <tr>
              <td>Hóa đơn</td>
              <td>Ngày đặt</td>
              <td>Tổng tiền</td>
              <td>Thao tác</td>
            </tr>
          </thead>
          <tbody id="showOrder"></tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="Pagination">
        <div class="container">
          <ul id="pagination"></ul>
        </div>
      </div>
    </div>

    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="assets/js/admin.js"></script>
    <script>
      // Sample data (matching admin-hoadon.php)
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

      // Get customerId from URL, default to 1 if not provided
      const urlParams = new URLSearchParams(window.location.search);
      let customerId = parseInt(urlParams.get("customerId")) || 1;

      // Update reset link to preserve customerId
      document.querySelector('.reset-order[href="adminthongkechitiet.php"]').href = `adminthongkechitiet.php?customerId=${customerId}`;

      function thongKe(sortOrder = 2, page = 1) {
        const startDate = document.getElementById("time-start-tk").value;
        const endDate = document.getElementById("time-end-tk").value;
        const searchQuery = document.getElementById("form-search-tk").value.toLowerCase();
        const itemsPerPage = 5;

        // Filter orders by customerId
        let filteredOrders = orders.filter(order => order.customerId === customerId);

        // Filter by date range
        filteredOrders = filteredOrders.filter(order => {
          const orderDate = new Date(order.date);
          const start = startDate ? new Date(startDate) : null;
          const end = endDate ? new Date(endDate) : null;
          return (!start || orderDate >= start) && (!end || orderDate <= end);
        });

        // Filter by search query (orderId)
        if (searchQuery) {
          filteredOrders = filteredOrders.filter(order => order.orderId.toLowerCase().includes(searchQuery));
        }

        // Calculate total for each order
        const ordersWithTotal = filteredOrders.map(order => ({
          ...order,
          total: order.items.reduce((sum, item) => sum + item.price * item.quantity, 0) + order.shippingCost
        }));

        // Sort orders
        ordersWithTotal.sort((a, b) => sortOrder === 1 ? a.total - b.total : b.total - a.total);

        // Pagination
        const totalPages = Math.ceil(ordersWithTotal.length / itemsPerPage);
        const paginatedOrders = ordersWithTotal.slice((page - 1) * itemsPerPage, page * itemsPerPage);

        // Render table
        const tbody = document.getElementById("showOrder");
        tbody.innerHTML = "";
        if (paginatedOrders.length === 0) {
          tbody.innerHTML = '<tr><td colspan="4">Không có đơn hàng nào.</td></tr>';
        } else {
          paginatedOrders.forEach(order => {
            // Format date to DD/MM/YYYY
            const dateParts = order.date.split('-');
            const formattedDate = `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
            const row = `
              <tr>
                <td>${order.orderId}</td>
                <td>${formattedDate}</td>
                <td>${order.total.toLocaleString()} ₫</td>
                <td class="control">
                  <a href="adminthongkehoadon.php?orderId=${order.orderId}" class="btn-detail">
                    <i class="fa-regular fa-eye"></i> Chi tiết
                  </a>
                </td>
              </tr>
            `;
            tbody.innerHTML += row;
          });
        }

        // Render pagination
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";
        for (let i = 1; i <= totalPages; i++) {
          const li = `
            <li>
              <a href="#" class="inner-trang ${i === page ? 'trang-chinh' : ''}" onclick="thongKe(${sortOrder}, ${i}); return false;">
                ${i}
              </a>
            </li>
          `;
          pagination.innerHTML += li;
        }
      }

      // Initial render
      thongKe();
    </script>
  </body>
</html>