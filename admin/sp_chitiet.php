<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 28-Mar-17
 * Time: 13:19
*/
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Chi tiết sản phẩm</title>
    <?php include_once('header2.php');?>
    <style>
        div.row { padding-top: 3%;}
    </style>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">Chi tiết sản phẩm</h3>
<?php
include_once ('../connection/connect_database.php');
$q_sanpham = "select * from sanpham where idSP =".$_GET['idSP'];
$rs_sanpham = mysqli_query($conn,$q_sanpham);
if(!$rs_sanpham)
{
    echo"<script language='JavaScript'> alert('Không thể kết nối');";
    echo" location.href = 'index_ds_sp.php'; </script>";
}
$row_sanpham = mysqli_fetch_array($rs_sanpham);

?>
<form method="post" action="" name="ChiTietSP" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Mã sản phẩm</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['idSP'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Tên sản phẩm</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['TenSP'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Nhãn hiệu</strong></div>
        <?php
        $q_nh = "select TenNH from nhanhieu WHERE idNH =".$row_sanpham['idNH'];
        $rs_nh = mysqli_query($conn,$q_nh);
        $r_nh = mysqli_fetch_array($rs_nh);
        ?>
        <div class="col-md-9"><?php echo $r_nh['TenNH'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Loại nước hoa</strong></div>
        <?php
        $q_l = "select TenL from loaisp WHERE idL =".$row_sanpham['idL'];
        $rs_l = mysqli_query($conn,$q_l);
        $r_l = mysqli_fetch_array($rs_l);
        ?>
        <div class="col-md-9"><?php echo $r_l['TenL'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Giá bán</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['GiaBan'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Giá khuyến mãi</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['GiaKhuyenmai'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Số lượng tồn</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['SoLuongTonKho'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Hình đại diện</strong></div>
        <div class="col-md-9"><img width="50%" height="50%" src="../images/<?php echo $row_sanpham['urlHinh'];?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Số lượng đã xem</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['SoLanXem'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Bài viết liên quan</strong></div>
        <div class="col-md-9"><strong>Xem</strong></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Số lần mua</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['SoLanMua'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ghi Chú</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['GhiChu'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Mô tả </strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['MoTa'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ngày cập nhật</strong></div>
        <div class="col-md-9"><?php echo $row_sanpham['NgayCapNhat'];?></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
        <div class="col-md-9"><?php if($row_sanpham['AnHien'] ==1) echo "Hiện"; else echo "Ẩn"; ?></div>
    </div>
    <div class="row"> <input type="submit" name="trove" value="Trở về" onclick="getConfirmation()" ;></div>
</form>
<?php
    if(isset($_POST['trove']))
    {
        echo "<script type=\"text/javascript\">
        if (confirm(\"Bạn có muốn trỏ về không ?\") == true) {
                location.href='index_ds_sp.php';
    }
</script>";
    }
?>


<?php include_once ('footer.php');?>
</body>
</html>
<!-- <?php
$sl_loai = "select TenL from loaisp WHERE idL =".$r['idL'];
$result_loai = mysqli_query($conn,$sl_loai);
$r_loai = mysqli_fetch_array($result_loai);
?> -->