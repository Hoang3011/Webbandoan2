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
    <!-- header top  -->
    <?php 
    include "includes/headerlogin.php";
    ?>
    <!-- End header bottom  -->

    <!-- Account -->

    <div class="ThongTin">
      <div class="container">
        <div class="row">
          <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
            <div class="inner-item">
              <div class="inner-tt">Giỏ hàng</div>
              <div class="inner-gth">
                <div class="inner-img">
                  <img src="assets/img/products/banhmi.webp" />
                </div>
                <div class="inner-mota">
                  <div class="inner-ten">Bánh mì</div>
                  <div class="inner-sl">Số lượng: 1</div>
                  <div class="inner-gia">20.000 ₫</div>
                </div>
              </div>
              <div class="inner-gth">
                <div class="inner-img">
                  <img src="assets/img/products/bunbohue.jpg" />
                </div>
                <div class="inner-mota">
                  <div class="inner-ten">Bún bò Huế</div>
                  <div class="inner-sl">Số lượng: 1</div>
                  <div class="inner-gia">50.000 ₫</div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="inner-item">
                  <form action="">
                    <div class="inner-tt">Thông tin khách hàng</div>
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="form-group">
                          <label for="name">Họ và tên:</label>
                          <input
                            type="text"
                            id="name"
                            class="form-control"
                            value="Cao Thái Phương Thanh"
                          />
                        </div>
                      </div>
                      <div class="col-xl-4">
                        <div class="form-group">
                          <label for="sdt">Số điện thoại:</label>
                          <input
                            type="text"
                            id="sdt"
                            class="form-control"
                            value="0909098386"
                          />
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <div class="form-group">
                          <label for="diachi">Địa chỉ:</label>
                          <input
                            type="text"
                            id="diachi"
                            class="form-control"
                            value="273 An Dương Vương, Phường 3, Quận 5, TP Hồ Chí Minh"
                          />
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <div class="form-group">
                          <label for="ghichu">Ghi chú đơn hàng:</label>
                          <textarea
                            type="text"
                            id="ghichu"
                            class="form-control"
                            placeholder="Ghi chú"
                          ></textarea>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-12">
                <div class="inner-item">
                  <div class="PhuongThuc">
                    <div class="inner-body">
                      <div class="inner-tt">Phương thức thanh toán</div>
                      <div class="accordion" id="accordionFaqs">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button
                                class="btn btn-link btn-block text-left"
                                type="button"
                                data-toggle="collapse"
                                data-target="#collapseOne"
                                aria-expanded="true"
                                aria-controls="collapseOne"
                              >
                                <div class="inner-icon">
                                  <img src="assets/img/cod.png" />
                                </div>
                                <div class="inner-chu">
                                  Thanh toán tiền mặt khi nhận hàng
                                </div>
                              </button>
                            </h2>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                              <button
                                class="btn btn-link btn-block text-left collapsed"
                                type="button"
                                data-toggle="collapse"
                                data-target="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo"
                              >
                                <div class="inner-icon">
                                  <img src="assets/img/bank.png" />
                                </div>
                                <div class="inner-chu">
                                  Chuyển khoản ngân hàng
                                </div>
                              </button>
                            </h2>
                          </div>
                          <div
                            id="collapseTwo"
                            class="collapse"
                            aria-labelledby="headingTwo"
                            data-parent="#accordionFaqs"
                          >
                            <div class="card-body">
                              <div class="row">
                                <div class="col-xl-12">
                                  <div class="inner-tt">
                                    Tài khoản ngân hàng
                                  </div>
                                </div>
                                <div class="col-xl-6">
                                  <div class="inner-nhleft">Tên ngân hàng</div>
                                </div>
                                <div class="col-xl-6">
                                  <div class="inner-nhright">
                                    Ngân hàng MB (MBBank)
                                  </div>
                                </div>
                                <div class="col-xl-6">
                                  <div class="inner-nhleft">Chủ tài khoản</div>
                                </div>
                                <div class="col-xl-6">
                                  <div class="inner-nhright">
                                    Nguyễn Văn Thành Đại
                                  </div>
                                </div>
                                <div class="col-xl-6">
                                  <div class="inner-nhleft">Số tài khoản</div>
                                </div>
                                <div class="col-xl-6">
                                  <div class="inner-nhright">0978021799</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
            <div class="inner-item">
              <div class="inner-tien">
                <div class="inner-th">Tiền hàng <span>2 món</span></div>
                <div class="inner-st">70.000 ₫</div>
              </div>
              <div class="inner-tien">
                <div class="inner-pvc">Phí vận chuyển</div>
                <div class="inner-st">30.000 ₫</div>
              </div>
              <div class="inner-tientong">
                <div class="inner-tong">Tổng tiền</div>
                <div class="inner-total">100.000 ₫</div>
              </div>
              <a href="login.html" class="button" onclick="tinhTien()"
                >Thanh toán</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End Account -->

    <!-- Footer-top -->
     <?php 
     include "includes/footer.php";
     
     ?>
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
