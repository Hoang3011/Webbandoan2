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
    <title>Admin</title>
    <link href="./assets/img/logo.png" rel="icon" type="image/x-icon" />
  </head>

  <body>
    <?php include_once "includes/headeradmin.php"; ?>

    <div class="admin-product">
      <div class="admin-control">
        <div class="admin-control-left">
          <select name="the-loai" id="the-loai" onchange="fetchProducts()">
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
        <div class="admin-control-center">
          <form onsubmit="fetchProducts(); return false;">
            <span onclick="fetchProducts()" class="search-btn"><i class="fa-light fa-magnifying-glass"></i></span>
            <input id="form-search-product" type="text" class="form-search-input" placeholder="Tìm kiếm tên món..." />
          </form>
        </div>
        <div class="admin-control-right">
          <a href="adminproduct.php" class="inner-nut"><i class="fa-light fa-rotate-right"></i> Làm mới</a>
          <a href="adminaddproduct.php" class="inner-nut"><i class="fa-light fa-plus"></i> Thêm món mới</a>
        </div>
      </div>

      <div id="product-results" style="display: none;"></div>

      <div id="default-product-list" class="show-product">
        <div class="row">
          <?php
          include "./connect.php";
          $limit = 12;
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $start = ($page - 1) * $limit;

          $total_query = "SELECT COUNT(*) AS total FROM sanpham";
          $total_result = mysqli_query($conn, $total_query);
          $total_row = mysqli_fetch_assoc($total_result);
          $total_products = $total_row['total'];

          $total_pages = ceil($total_products / $limit);

                  
        $sql = "SELECT * FROM sanpham LIMIT $start, $limit";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
          // Kiểm tra Visible
          $borderStyle = ($row['Visible'] == 0) ? 'style="border: 1px solid red;"' : '';
        ?>
          <div class="col-12">
            <div class="list" data-id="<?= $row['ID']; ?>" <?= $borderStyle; ?>>
              <div class="list-left">
                <img src="<?php echo $row['Image']; ?>" alt="<?php echo $row['Name']; ?>" />
                <div class="list-info">
                  <h4><?php echo $row['Name']; ?></h4>
                  <p><?php echo $row['Describtion']; ?></p>
                  <div class="list-category"><?php echo $row['Type']; ?></div>
                </div>
              </div>
              <div class="list-right">
                <div class="list-price"><?php echo $row['Price'] . ".000₫"; ?></div>
                <div class="list-control">
                  <div class="list-tool">
                    <a href="adminchangeproduct.php?id=<?= $row['ID']; ?>" class="btn-edit">
                      <i class="fa-light fa-pen-to-square"></i>
                    </a>
                    <button class="btn-delete" onclick="confirmDelete(<?= $row['ID']; ?>)">
                      <i class="fa-regular fa-trash"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

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
    </div>

    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="assets/js/admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
  function fetchProducts() {
    fetchProductsPage(1);
  }

  function fetchProductsPage(page) {
    var category = document.getElementById("the-loai").value;
    var searchTerm = document.getElementById("form-search-product").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./includes/searchadmin.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        try {
          // Parse the JSON response
          var response = JSON.parse(xhr.responseText);
          var products = response.products || [];
          var total_pages = response.total_pages || 1;

          // Generate HTML for the product list
          var html = '<div class="row">';
          if (products.length === 0) {
            html += '<p>Không tìm thấy sản phẩm nào.</p>';
          } else {
            products.forEach(function (product) {
              html += `
                <div class="col-12">
                  <div class="list" style="${product.Visible == 0 ? 'border: 1px solid red;' : ''}" data-id="${product.ID}">
                    <div class="list-left">
                      <img src="${product.Image}" alt="${product.Name}" />
                      <div class="list-info">
                        <h4>${product.Name}</h4>
                        <p>${product.Describtion}</p>
                        <div class="list-category">${product.Type}</div>
                      </div>
                    </div>
                    <div class="list-right">
                      <div class="list-price">${product.Price}.000₫</div>
                      <div class="list-control">
                        <div class="list-tool">
                          <a href="adminchangeproduct.php?id=${product.ID}" class="btn-edit">
                            <i class="fa-light fa-pen-to-square"></i>
                          </a>
                          <button class="btn-delete" onclick="confirmDelete(${product.ID})">
                            <i class="fa-regular fa-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              `;
            });
          }
          html += '</div>';

          // Add pagination
          if (total_pages > 1) {
            html += '<div class="Pagination"><div class="container"><ul>';
            for (var i = 1; i <= total_pages; i++) {
              var activeClass = i === page ? 'trang-chinh' : '';
              html += `<li><a href="#" class="inner-trang ${activeClass}" onclick="fetchProductsPage(${i}); return false;">${i}</a></li>`;
            }
            html += '</ul></div></div>';
          }

          // Update the product-results div
          document.getElementById("product-results").innerHTML = html;
          document.getElementById("product-results").style.display = "block";
          document.getElementById("default-product-list").style.display = "none";
        } catch (e) {
          console.error("Error parsing JSON:", e);
          document.getElementById("product-results").innerHTML = "<p>Lỗi khi tải sản phẩm.</p>";
          document.getElementById("product-results").style.display = "block";
          document.getElementById("default-product-list").style.display = "none";
        }
      }
    };

    xhr.send("category=" + encodeURIComponent(category) + "&search=" + encodeURIComponent(searchTerm) + "&page=" + page);
  }

  function resetSearch() {
    document.getElementById("form-search-product").value = "";
    document.getElementById("the-loai").value = "";
    document.getElementById("product-results").innerHTML = "";
    document.getElementById("product-results").style.display = "none";
    document.getElementById("default-product-list").style.display = "block";
  }

  function confirmDelete(productId) {
    // Gửi yêu cầu AJAX để kiểm tra Visible
    var xhrCheck = new XMLHttpRequest();
    xhrCheck.open("POST", "check_visible.php", true);
    xhrCheck.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhrCheck.onreadystatechange = function () {
        if (xhrCheck.readyState == 4 && xhrCheck.status == 200) {
            var response = xhrCheck.responseText;
            if (response === "visible") {
                // Trường hợp Visible = 1: Hiển thị thông báo ẩn sản phẩm
                Swal.fire({
                    title: 'Bạn có muốn ẩn món ăn?',
                    text: "Món ăn này sẽ bị ẩn khỏi hệ thống!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ẩn',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu cập nhật Visible = 0
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "deleteproduct.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200 && xhr.responseText === "success") {
                                    Swal.fire(
                                        'Đã ẩn!',
                                        'Món ăn đã được ẩn thành công.',
                                        'success'
                                    ).then(() => {
                                        document.querySelector(`.list[data-id="${productId}"]`)?.remove();
                                    });
                                } else {
                                    Swal.fire(
                                        'Lỗi!',
                                        'Không thể ẩn món ăn: ' + xhr.responseText,
                                        'error'
                                    );
                                }
                            }
                        };

                        xhr.send("id=" + productId);
                    }
                });
            } else if (response === "hidden") {
                // Trường hợp Visible = 0: Hiển thị thông báo xóa vĩnh viễn
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Món ăn này sẽ bị xóa vĩnh viễn!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu xóa sản phẩm
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "deleteproduct.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200 && xhr.responseText === "success") {
                                    Swal.fire(
                                        'Đã xóa!',
                                        'Món ăn đã được xóa thành công.',
                                        'success'
                                    ).then(() => {
                                        document.querySelector(`.list[data-id="${productId}"]`)?.remove();
                                    });
                                } else {
                                    Swal.fire(
                                        'Lỗi!',
                                        'Không thể xóa món ăn: ' + xhr.responseText,
                                        'error'
                                    );
                                }
                            }
                        };

                        xhr.send("id=" + productId);
                    }
                });
            } else {
                Swal.fire(
                    'Lỗi!',
                    'Không thể kiểm tra trạng thái món ăn: ' + response,
                    'error'
                );
            }
        }
    };

    xhrCheck.send("id=" + productId);
}
</script>
  </body>
</html>