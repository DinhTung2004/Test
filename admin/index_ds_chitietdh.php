<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 13-Apr-17
 * Time: 21:00
 */
include_once('../connection/connect_database.php');
$sl_ctdonhang = "select * from donhangchitiet where idDH =" . $_GET['idDH'];
$rs_ctdonhang = mysqli_query($conn, $sl_ctdonhang);
if (!$rs_ctdonhang)
    echo "Không thể truy vấn CSDL"; ?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Chi tiết đơn hàng </title>
    <?php include_once('header2.php'); ?>
</header>
<body>
<?php include_once('header3.php'); ?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">DANH SÁCH CHI TIẾT ĐƠN HÀNG</h3>
<div style="overflow-x: scroll">
    <table class=" table table-bordered hover" style="overflow-x: scroll" border="2">
        <thead class="text-center">
        <tr>
            <td width=""><strong> ID ĐƠN HÀNG</strong></td>
            <td width=""><strong> ID SẢN PHẨM </strong></td>
            <td width=""><strong> TÊN SẢN PHẨM</strong></td>
            <td width=""><strong> SỐ LƯỢNG </strong></td>
            <td width=""><strong> GIÁ</strong></td>
            <td width=""><strong> THÀNH TIỀN</strong></td>
        </tr>
        </thead>
        <?php $tong = 0;
        while ($r = $rs_ctdonhang->fetch_assoc()) { ?>
            <tbody>
            <td width=""><strong> <?php echo $r['idDH'];; ?> </strong></td>
            <td width=""><strong><?php echo $r['idSP']; ?> </strong></td>
            <td width=""><strong><?php echo $r['TenSP']; ?> </strong></td>
            <td width=""><strong><?php echo $r['SoLuong']; ?> </strong></td>
            <td width=""><strong><?php echo $r['Gia']; ?> </strong></td>
            <td width=""><strong><?php echo $r['Gia'] * $r['SoLuong'];
                    $tong += $tong + $r['Gia'] * $r['SoLuong']; ?> </strong></td>
            </tbody>
        <?php } ?>
    </table>
</div>

<div class="row">
    <div class="col-lg-offset-3"><h2>Tổng tiền:<strong><?php echo $tong; ?> </strong></h2></div>
</div>
<?php include_once('footer.php'); ?>
</body>
</html>
