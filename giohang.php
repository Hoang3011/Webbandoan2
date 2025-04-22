<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/font-awesome-pro-v6-6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Đặc sản 3 miền</title>
    <link href="./assets/img/logo.png" rel="icon" type="image/x-icon" />
    <style>
        .giohang {
            padding-top: 70px;
            padding-bottom: 30px;
        }

        .btn {
            background: var(--color-bg2);
            color: #fff;
        }

        .remove {
            border: 0;
            color: var(--color-bg2);
            background: #fff;
            cursor: pointer;
        }

        .btn-reduce, .btn-increment {
            width: 30px;
            height: 30px;
            border: 1px solid #ccc;
            background: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .button-quantity input {
            width: 50px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            height: 30px;
        }

        .price {
            font-weight: 500;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .bg-light-gray {
            background-color: #f6f6f6;
        }

        .bg-cream {
            background-color: #f7f4ef;
        }

        .bg-success {
            height: 4px;
        }

        .link_404 {
            display: inline-block;
            padding: 10px 20px;
            background: var(--color-bg2);
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
        }

        .link_404:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php include "includes/headerlogin.php" ?>
<div class="giohang">
    <div class="container">
        <?php
        include 'connect.php';
        $makh = $_SESSION['makh'];
        $sql = "
        SELECT gh.*, sp.Name, sp.Image 
        FROM giohang gh 
        JOIN sanpham sp ON gh.masp = sp.ID 
        WHERE gh.makh = ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $makh);
        $stmt->execute();
        $result = $stmt->get_result();
        $tong = 0;
        $has_items = $result->num_rows > 0;

        if (!$has_items):
        ?>
            <div class="text-center mt-5">
                <h1 class="h4 font-weight-bold mb-4">Bạn chưa chọn sản phẩm.</h1>
                <div class="d-flex justify-content-center mb-4">
                    <img alt="Sad shopping bag with a tear drop" class="img-fluid w-25" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwOMCokhISLytLOTqrD7o2SG_MwMidXcFYNg&s">
                </div>
                <p class="text-muted mb-5">Hãy nhanh tay chọn ngay sản phẩm yêu thích.</p>
                <div class="contant_box_404">
                    <a class="link_404" href="login.php" data-discover="true">Buy Now</a>
                </div>
            </div>
        <?php else: ?>
            <h2 class="text-3xl font-semibold text-center mb-5">Giỏ Hàng</h2>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()):
                                    $tong += $row['tongtien'];
                                ?>
                                <tr data-id="<?= $row['masp'] ?>">
                                    <td>
                                        <div class="d-flex align-items-center p-3">
                                            <div class="w-25 mr-3">
                                                <img class="img-fluid rounded" src="<?= $row['Image'] ?>" alt="<?= $row['Name'] ?>">
                                            </div>
                                            <div>
                                                <p class="text-sm text-uppercase mb-1"><?= $row['Name'] ?></p>
                                                <span class="text-sm"><?= number_format($row['dongia']) ?>.000đ</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="button-quantity">
                                            <button type="button" class="btn-reduce">-</button>
                                            <input type="number" class="qty" value="<?= $row['soluong'] ?>" min="1">
                                            <button type="button" class="btn-increment">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price"><?= number_format($row['tongtien']) ?>.000đ</div>
                                    </td>
                                    <td>
                                        <button type="button" class="remove p-0">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <p class="text-md">Ghi chú cho người bán</p>
                        <textarea class="form-control mt-2" placeholder="Chúng tôi có thể giúp gì cho bạn?" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-cream p-4 mb-4">
                        <h5 class="text-uppercase font-weight-medium text-sm">MIỄN PHÍ VẬN CHUYỂN CHO ĐƠN HÀNG TỪ 500.000đ</h5>
                        <p class="text-sm mt-2">Chúc mừng, bạn được miễn phí vận chuyển!</p>
                        <div class="bg-success w-100 mt-3"></div>
                    </div>
                    <div class="card bg-light-gray p-4">
                        <span>Mã giảm giá</span>
                        <p class="mt-2 mb-4 text-sm text-muted">* Giảm giá sẽ được tính và áp dụng khi thanh toán</p>
                        <input class="form-control h-10 mb-4" placeholder="Coupon code" type="text">
                        <p class="font-weight-bold">Total: <?= number_format($tong) ?>.000đ</p>
                        <form action="<?php echo isset($_SESSION['makh']) ? 'thanhtoan.php?makh=' . urlencode($_SESSION['makh']) : 'giohang.php'; ?>" method="post">
                            <button type="submit" class="btn btn-block mt-4 rounded-pill">Thanh toán</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php include "includes/footer.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn-increment').click(function() {
        let row = $(this).closest('tr');
        let input = row.find('.qty');
        let val = parseInt(input.val()) || 1;
        let id = row.data('id');
        $.post('capnhat_giohang.php', { masp: id, soluong: val + 1 }, function() {
            location.reload();
        });
    });
    $('.btn-reduce').click(function() {
        let row = $(this).closest('tr');
        let input = row.find('.qty');
        let val = parseInt(input.val()) || 1;
        let id = row.data('id');
        if (val > 1) {
            $.post('capnhat_giohang.php', { masp: id, soluong: val - 1 }, function() { 
                location.reload();
            });
        }
    });
    $('.qty').change(function() {
        let row = $(this).closest('tr');
        let id = row.data('id');
        let qty = $(this).val();
        if (qty >= 1) {
            $.post('capnhat_giohang.php', { masp: id, soluong: qty }, function() {
                location.reload();
            });
        }
    });
    $('.remove').click(function() {
        let row = $(this).closest('tr');
        let id = row.data('id');
        $.post('xoa_giohang.php', { masp: id }, function() {
            location.reload();
        });
    });
});
</script>
</body>
</html>