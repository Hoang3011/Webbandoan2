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
include "connect.php";

if (isset($_POST['addproduct'])) {
    $Name = $_POST['Name'];
    $Price = $_POST['Price'];
    $Describtion = $_POST['Describtion'];
    $Type = $_POST['Type'];
    $Image =$_FILES['Images']['name'];
    $Image_tmp_name=$_FILES['Images']['tmp_name'];
    $target_dir = "assets/img/products/"; // Thư mục lưu trữ hình ảnh
    $target_file = $target_dir . basename($Image); // Đường dẫn đầy đủ của ảnh
    $sql = "INSERT INTO sanpham (Name, Image, Price, Describtion, Type) 
            VALUES ('$Name', '$target_file', '$Price', '$Describtion', '$Type')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Thêm sản phẩm thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>

    <?php
    include_once "./includes/headeradmin.php";
     ?>
      <!-- adminaddproduct  -->

      <div class="adminaddproduct">
      <div class="add-product"> 
    <div class="row">
        <div class="col-12">
            <div class="inner-head">
                <div class="inner-title">Thêm sản phẩm mới</div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="inner-item">
                <div class="inner-img">
                    <img id="preview" src="assets/img/admin/blank-image.png" />
                </div>
                <div class="inner-choose">
                    <label for="choose">
                        <i class="fa-light fa-cloud-arrow-up"></i> Chọn hình ảnh
                    </label>
                    <input
                        id="choose"
                        type="file"
                        accept="image/png, image/jpg, image/jpeg, image/gif"
                        name="Images"
                        onchange="previewImage(event)"
                    />
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="inner-item">
                    <div class="form-group">
                        <label for="name">Tên món</label>
                        <input type="text" id="name" name="Name" class="form-control" placeholder="Nhập tên món" required />
                    </div>
                    <div class="inner-select">
                        <label for="select">Chọn món</label>
                        <select name="Type" id="select">
                            <option value="món chay">Món chay</option>
                            <option value="món mặn">Món mặn</option>
                            <option value="món lẩu">Món lẩu</option>
                            <option value="món ăn vặt">Món ăn vặt</option>
                            <option value="món tráng miệng">Món tráng miệng</option>
                            <option value="nước uống">Nước uống</option>
                            <option value="hải sản">Hải sản</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sell">Giá bán</label>
                        <input type="number" id="sell" name="Price" class="form-control" placeholder="Nhập giá bán" required />
                    </div>
                    <div class="form-group">
                        <label for="desc">Mô tả</label>
                        <textarea name="Describtion" id="desc" class="form-control" placeholder="Nhập mô tả món ăn..." required></textarea>
                    </div>
                    <div class="inner-add">
                        <button class="inner-nut" name="addproduct" type="submit">
                            <i class="fa-solid fa-plus"></i> Thêm món
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>


        <!-- End Modal Add Product -->
      </div>
    </div>

    <!-- End adminadminaddproduct  -->

    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="assets/js/admin.js"></script>
  </body>
</html>
