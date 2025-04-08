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

    <link
      rel="stylesheet"
      href="assets/font-awesome-pro-v6-6.2.0/css/all.min.css"
    />

    <link rel="stylesheet" href="admin/css/style.css" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/admin.css" />

    <title>Admin</title>
    <link href="./assets/img/logo.png" rel="icon" type="image/x-icon" />
    
    <style>
      .form-control {
        height: 40px !important;
        background: #fff;
        color: #000;
        font-size: 15px;
        border-radius: 4px;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #ced4da;
        margin: 0px;
        transition: all 0.3s linear;
      }

      .adminaddproduct .add-product .form-control:hover {
    border: 1px solid var(--color-bg2);
}

.adminaddproduct .add-product textarea {
    border: 1px solid #ced4da;
    height: 120px !important;
    padding: 15px;
    background-color: #f7f7f7;
    transition: all 0.3s linear;
    font-size: 14px;
}
    </style>
  </head>

  <body>
    <?php 
      include_once "./includes/headeradmin.php";
      include "connect.php";

      if (isset($_GET['id'])) {
          $id = intval($_GET['id']);
          $sql = "SELECT * FROM sanpham WHERE ID = $id";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
          } else {
              echo "<h2>Không tìm thấy sản phẩm!</h2>";
              exit();
          }
      } else {
          echo "<h2>Không có sản phẩm nào được chọn!</h2>";
          exit();
      }
    ?>

    <div class="adminaddproduct">
      <div class="add-product"> 
        <div class="row">
          <div class="col-12">
            <div class="inner-head">
              <div class="inner-title">Chỉnh sửa sản phẩm</div>
            </div>
          </div>
          
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <form action="updateproduct.php" method="POST" enctype="multipart/form-data">
              <div class="inner-item">
                <div class="inner-img">
                  <img id="preview" src="<?php echo $row['Image']; ?>" />
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
                <input 
                  type="text" 
                  id="name" 
                  name="Name" 
                  class="form-control" 
                  placeholder="Nhập tên món" 
                  value="<?php echo htmlspecialchars($row['Name']); ?>" 
                  required 
                />
              </div>
              
              <div class="inner-select">
                <label for="select">Chọn món</label>
                <select name="Type" id="select" class="form-control">
                  <option value="món chay" <?php echo ($row['Type'] == 'món chay') ? 'selected' : ''; ?>>Món chay</option>
                  <option value="món mặn" <?php echo ($row['Type'] == 'món mặn') ? 'selected' : ''; ?>>Món mặn</option>
                  <option value="món lẩu" <?php echo ($row['Type'] == 'món lẩu') ? 'selected' : ''; ?>>Món lẩu</option>
                  <option value="món ăn vặt" <?php echo ($row['Type'] == 'món ăn vặt') ? 'selected' : ''; ?>>Món ăn vặt</option>
                  <option value="món tráng miệng" <?php echo ($row['Type'] == 'món tráng miệng') ? 'selected' : ''; ?>>Món tráng miệng</option>
                  <option value="nước uống" <?php echo ($row['Type'] == 'nước uống') ? 'selected' : ''; ?>>Nước uống</option>
                  <option value="hải sản" <?php echo ($row['Type'] == 'hải sản') ? 'selected' : ''; ?>>Hải sản</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="sell">Giá bán</label>
                <input 
                  type="number" 
                  id="sell" 
                  name="Price" 
                  class="form-control" 
                  placeholder="Nhập giá bán" 
                  value="<?php echo htmlspecialchars($row['Price']); ?>" 
                  required 
                />
              </div>
              
              <div class="form-group">
                <label for="desc">Mô tả</label>
                <textarea 
                  name="Describtion" 
                  id="desc" 
                  class="form-control" 
                  placeholder="Nhập mô tả món ăn..." 
                  required
                ><?php echo htmlspecialchars($row['Describtion']); ?></textarea>
              </div>
              
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              
              <div class="inner-add">
                <button class="inner-nut" type="submit">
                  <i class="fa-light fa-pencil"></i> Lưu thay đổi
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

    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <script src="admin/js/popper.js"></script>
    <script src="assets/js/admin.js"></script>
  </body>
</html>