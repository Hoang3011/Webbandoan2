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
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="custom-menu">
          <button
            type="button"
            id="sidebarCollapse"
            class="btn btn-primary"
          ></button>
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
            <a href="admin.html"
              ><i class="fa-light fa-house"></i> Trang tổng quan</a
            >
          </li>
          <li>
            <a href="adminproduct.html"
              ><i class="fa-light fa-pot-food"></i> Sản phẩm</a
            >
          </li>
          <li>
            <a href="admincustomer.html"
              ><i class="fa-light fa-users"></i> Khách hàng</a
            >
          </li>
          <li class="active">
            <a href="adminorder.html"
              ><i class="fa-light fa-basket-shopping"></i> Đơn hàng</a
            >
          </li>
          <li>
            <a href="adminstatistical.html"
              ><i class="fa-light fa-chart-simple"></i> Thống kê</a
            >
          </li>
        </ul>
      </nav>

      <!-- adminorder  -->

      <div class="admin-order">
        <div class="admin-control">
          <div class="admin-control-left">
            <select name="tinh-trang-user" id="tinh-trang-user">
              <option value="0">Tất cả</option>
              <option value="1">Chưa xử lý</option>
              <option value="2">Đã xác nhận</option>
              <option value="3">Đã giao thành công</option>
              <option value="4">Đã huỷ</option>
            </select>
          </div>
          <div class="admin-control-center">
            <form action="">
              <span class="search-btn"
                ><i class="fa-light fa-magnifying-glass"></i
              ></span>
              <input
                id="form-search-product"
                type="text"
                class="form-search-input"
                placeholder="Tìm kiếm khách hàng..."
              />
            </form>
          </div>
          <div class="admin-control-right">
            <form action="" class="fillter-date">
              <div>
                <label for="time-start">Từ</label>
                <input
                  type="date"
                  class="form-control-date"
                  id="time-start-user"
                  onchange="showUser()"
                />
              </div>
              <div>
                <label for="time-end">Đến</label>
                <input
                  type="date"
                  class="form-control-date"
                  id="time-end-user"
                  onchange="showUser()"
                />
              </div>
            </form>
            <a href="adminorder.html" class="reset-order"
              ><i class="fa-light fa-arrow-rotate-right"></i
            ></a>
          </div>
        </div>

        <div class="table">
          <table width="100%">
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
              <tr>
                <td>DH1</td>
                <td>Thanh</td>
                <td>20/11/2024</td>
                <td>100.000 ₫</td>
                <td>
                  <span id="order-status-1" class="status-complete"
                    >Đã giao thành công</span
                  >
                </td>
                <td class="control">
                  <a href="adminchitiet.html" class="btn-detail">
                    <i class="fa-regular fa-eye"></i> Chi tiết
                  </a>
                </td>
              </tr>
              <tr>
                <td>DH2</td>
                <td>Nguyen Dai</td>
                <td>12/11/2024</td>
                <td>75.000 ₫</td>
                <td><span class="status-complete">Đã giao thành công</span></td>
                <td class="control">
                  <a href="adminchitiet.html" class="btn-detail">
                    <i class="fa-regular fa-eye"></i> Chi tiết
                  </a>
                </td>
              </tr>
              <tr>
                <td>DH3</td>
                <td>Nguyen Hoang</td>
                <td>28/11/2024</td>
                <td>80.000 ₫</td>
                <td><span class="status-middle-complete">Đã xác nhận</span></td>
                <td class="control">
                  <a href="adminchitiet.html" class="btn-detail">
                    <i class="fa-regular fa-eye"></i> Chi tiết
                  </a>
                </td>
              </tr>
              <tr>
                <td>DH4</td>
                <td>Dang Khoa</td>
                <td>21/11/2024</td>
                <td>540.000 ₫</td>
                <td><span class="status-no-complete">Chưa xử lý</span></td>
                <td class="control">
                  <a href="adminchitiet.html" class="btn-detail">
                    <i class="fa-regular fa-eye"></i> Chi tiết
                  </a>
                </td>
              </tr>
              <tr>
                <td>DH5</td>
                <td>Lu Nhan</td>
                <td>22/11/2024</td>
                <td>75.000 ₫</td>
                <td><span class="status-no-complete">Chưa xử lý</span></td>
                <td class="control">
                  <a href="adminchitiet.html" class="btn-detail">
                    <i class="fa-regular fa-eye"></i> Chi tiết
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Modal Admin Order -->

        <div
          class="modal fade"
          id="exampleModalCenter"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="inner-title">Chi tiết đơn hàng</div>
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
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="inner-item">
                      <div class="inner-info">
                        <div class="inner-img">
                          <img src="assets/img/products/banhmi.webp" />
                        </div>
                        <div class="inner-mota">
                          <div class="inner-ten">Bánh Mì</div>
                          <div class="inner-sl">SL: 1</div>
                        </div>
                      </div>
                      <div class="inner-gia">20.000 ₫</div>
                    </div>
                    <div class="inner-item">
                      <div class="inner-info">
                        <div class="inner-img">
                          <img src="assets/img/products/bunbohue.jpg" />
                        </div>
                        <div class="inner-mota">
                          <div class="inner-ten">Bún bò huế</div>
                          <div class="inner-sl">SL: 1</div>
                        </div>
                      </div>
                      <div class="inner-gia">50.000 ₫</div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-xl-6 col-md-6">
                    <div class="inner-pt">
                      <div class="inner-cachthuc">
                        <i class="fa-regular fa-calendar-days"></i>Ngày đặt hàng
                      </div>
                      <div class="inner-ketqua">20/11/2024</div>
                    </div>
                    <div class="inner-pt">
                      <div class="inner-cachthuc">
                        <i class="fa-solid fa-truck"></i>Hình thức giao
                      </div>
                      <div class="inner-ketqua">Giao tận nơi</div>
                    </div>
                    <div class="inner-pt">
                      <div class="inner-cachthuc">
                        <i class="fa-regular fa-credit-card"></i>PT thanh toán
                      </div>
                      <div class="inner-ketqua">Tiền mặt</div>
                    </div>
                    <div class="inner-pt">
                      <div class="inner-cachthuc">
                        <i class="fa-solid fa-person"></i>Người nhận
                      </div>
                      <div class="inner-ketqua">Phương Thanh</div>
                    </div>
                    <div class="inner-pt">
                      <div class="inner-cachthuc">
                        <i class="fa-solid fa-phone"></i>Số điện thoại
                      </div>
                      <div class="inner-ketqua">0909098386</div>
                    </div>
                    <div class="inner-diachi">
                      <div class="inner-cachthuc">
                        <i class="fa-solid fa-location-dot"></i>Địa chỉ nhận
                      </div>
                      <p class="inner-desc">
                        273 An Dương Vương, Phường 3, Quận 5, TP Hồ Chí Minh
                      </p>
                    </div>
                    <div class="inner-diachi">
                      <div class="inner-cachthuc">
                        <i class="fa-light fa-note-sticky"></i>Ghi chú
                      </div>
                      <p class="inner-desc"></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="inner-tien">
                  <div class="inner-th">Tiền hàng <span>2 món</span></div>
                  <div class="inner-st">70.000 ₫</div>
                </div>
                <div class="inner-vanchuyen">
                  <span class="inner-vc1">Vận chuyển</span>
                  <span class="inner-vc2">30.000 ₫</span>
                </div>
                <div class="inner-tonggia">
                  <div class="inner-giaca">
                    <div class="inner-chu">Thành tiền</div>
                    <div class="inner-so">100.000 ₫</div>
                  </div>
                  <div class="inner-select">
                    <label for="select">Trạng thái</label>
                    <select name="Món mặn" id="select">
                      <option>Chưa xử lý</option>
                      <option>Đã xác nhận</option>
                      <option selected>Đã giao thành công</option>
                      <option>Đã huỷ</option>
                    </select>
                  </div>
                </div>
                <div class="inner-capnhat">
                  <button onclick="updateOrder()" class="inner-nut">
                    <i class="fa-regular fa-floppy-disk"></i>Cập nhật trạng thái
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- End Modal Admin Order -->
      </div>
    </div>

    <!-- End adminorder  -->

    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="assets/js/admin.js"></script>
  </body>
</html>
