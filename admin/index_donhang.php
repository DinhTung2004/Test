<?php
session_start(); // Start session if not already started
include '../connection/connect_database.php';

$flag = isset($_SESSION['IDUser']); // Check login status

// If user is logged in, fetch their information from the database
if ($flag) {
    $sql_u = "SELECT * FROM users WHERE idUser = ?";
    $stmt_u = mysqli_prepare($conn, $sql_u);
    mysqli_stmt_bind_param($stmt_u, 'i', $_SESSION['IDUser']);
    mysqli_stmt_execute($stmt_u);
    $result_u = mysqli_stmt_get_result($stmt_u);
    $r_us = mysqli_fetch_array($result_u);
}

// Process order
if (isset($_POST['OK'])) {
    $orderDate = date("Y-m-d H:i:s");

    // Get customer name and other details
    if ($flag) {
        $customerName = $r_us['HoTenK'];
        $customerAddress = $r_us['DiaChi'];
        $customerPhone = $r_us['DienThoai'];
        $customerEmail = $r_us['Email'];
    } else {
        $customerName = $_POST['HoTen'] ?? 'Khách hàng';
        $customerAddress = $_POST['DiaChi'] ?? '';
        $customerPhone = $_POST['SDT'] ?? '';
        $customerEmail = $_POST['email'] ?? '';
    }

    // Calculate total price
    $tongtien = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $list) {
            $tongtien += $list['qty'] * $list['GiaBan'];
        }
    }

    // Get shipping fee from selected method
    $shippingFee = isset($_POST['PTGH']) ? $_POST['PTGH'] : 0;
    $totalAmount = $tongtien + $shippingFee;

    // Display order confirmation
    echo "
    <div class='alert alert-success text-center' style='margin-top: 20px;'>
        <h4>Cảm ơn <strong>$customerName</strong> đã đặt hàng!</h4>
        <p>Ngày giờ đặt hàng: <strong>$orderDate</strong></p>
        <p><b>Tên khách hàng:</b> $customerName</p>
        <p><b>Địa chỉ giao hàng:</b> $customerAddress</p>
        <p><b>Số điện thoại:</b> $customerPhone</p>
        <p><b>Email:</b> $customerEmail</p>
        <h4>Thông tin đơn hàng:</h4>";

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $list) {
            $totalProductPrice = $list['qty'] * $list['GiaBan'];
            echo "
            <div class='row'>
                <div class='col-md-12'><b>Số lượng:</b> {$list['qty']}</div>
            </div>
            <div class='row'>
                <div class='col-md-12'><b>Tên sản phẩm:</b> {$list['TenSP']}</div>
            </div>
            <div class='row'>
                <div class='col-md-12'><b>Đơn giá:</b> " . number_format($list['GiaBan'], 0) . " VNĐ</div>
            </div>
            <div class='row'>
                <div class='col-md-12'><b>Tổng tiền:</b> " . number_format($totalProductPrice, 0) . " VNĐ</div>
            </div>";
        }
    }

    echo "
        <div class='row'>
            <div class='col-md-12'><b>Phí vận chuyển:</b> " . number_format($shippingFee, 0) . " VNĐ</div>
        </div>
        <div class='row'>
            <div class='col-md-12'><b>Tổng cộng:</b> " . number_format($totalAmount, 0) . " VNĐ</div>
        </div>
        <button class='btn btn-primary' onclick='window.location.href=\"index.php\"'>Tiếp tục mua hàng</button>
    </div>";

    // Clear shopping cart
    unset($_SESSION['cart']);
    exit;
}

// Fetch shipping methods
$sql_pttt = 'SELECT * FROM phuongthucgiaohang WHERE AnHien = 1';
$rs = mysqli_query($conn, $sql_pttt);
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once("header.php"); ?>
    <title>Thanh toán</title>
    <?php include_once("header1.php"); ?>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .order-summary {
            background-color: #f5f3f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .order-summary h4 {
            text-align: center;
        }

        .order-summary .row {
            margin-bottom: 15px;
        }

        .btn-order {
            display: block;
            margin: 30px auto;
        }

        .order-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php include_once("header2.php"); ?>

    <div class="indexh3 text-center">
        <h3><?php echo $flag ? "Thông tin đặt hàng" : "Đặt hàng không cần đăng ký"; ?></h3>
        <div class="row text-center"><img src="../images/thanks.gif"></div>
    </div>

    <div class="container">
        <div class="row">
            <form action="" method="POST">
                <?php if ($flag) { ?>
                    <div class="col-md-8 order-info">
                        <h4>Thông tin giao hàng</h4>
                        <p><b>Tên khách hàng:</b> <?php echo $r_us['HoTenK']; ?></p>
                        <p><b>Địa chỉ:</b> <?php echo $r_us['DiaChi']; ?></p>
                        <p><b>Điện thoại:</b> <?php echo $r_us['DienThoai']; ?></p>
                        <p><b>Email:</b> <?php echo $r_us['Email']; ?></p>
                    </div>
                <?php } else { ?>
                    <div class="col-md-8 order-info">
                        <h4>Thông tin giao hàng</h4>
                        <div class="form-group">
                            <label for="HoTen">Họ tên người nhận:</label>
                            <input type="text" class="form-control" name="HoTen" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="abc@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="DiaChi">Địa chỉ nhận hàng:</label>
                            <textarea class="form-control" name="DiaChi" placeholder="Vui lòng nhập chính xác địa chỉ"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="SDT">Số điện thoại:</label>
                            <input type="tel" class="form-control" name="SDT" placeholder="Vui lòng nhập số điện thoại"
                                required>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-md-8">
                    <h4>Chọn phương thức nhận hàng:</h4>
                    <select name="PTGH" class="form-control" required>
                        <?php while ($r = $rs->fetch_assoc()) { ?>
                            <option value="<?php echo $r['idGH']; ?>">
                                <?php echo $r['TenGH'] . ' - ' . number_format($r['Phi'], 0) . ' VNĐ'; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-8">
                    <button type="submit" name="OK" class="btn btn-success btn-order">Đặt hàng</button>
                </div>
            </form>
        </div>

        <div class="order-summary">
            <h4>Thông tin đơn hàng</h4>
            <div class="row">
                <div class="col-md-2"><b>Số lượng</b></div>
                <div class="col-md-4"><b>Tên sản phẩm</b></div>
                <div class="col-md-3"><b>Đơn giá</b></div>
                <div class="col-md-3"><b>Tổng</b></div>
            </div>
            <?php
            $tongtien = 0;
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $list) {
                    $tongtien += $list['qty'] * $list['GiaBan'];
            ?>
                    <div class="row">
                        <div class="col-md-2"><?php echo $list['qty']; ?></div>
                        <div class="col-md-4"><?php echo $list['TenSP']; ?></div>
                        <div class="col-md-3"><?php echo number_format($list['GiaBan'], 0); ?></div>
                        <div class="col-md-3"><?php echo number_format($list['qty'] * $list['GiaBan'], 0); ?></div>
                    </div>
            <?php }
            } ?>
            <div class="row">
                <div class="col-md-12"><b>Phí vận chuyển:</b> <?php echo number_format($shippingFee, 0); ?> VNĐ</div>
            </div>
            <div class="row">
                <div class="col-md-12"><b>Tổng cộng:</b> <?php echo number_format($totalAmount, 0); ?> VNĐ</div>
            </div>
        </div>
    </div>
</body>

</html>