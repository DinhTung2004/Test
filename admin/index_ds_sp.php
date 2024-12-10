<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 16:00
 *
 * */
include_once ('../connection/connect_database.php');
$sl_sanpham = "select * from sanpham";
$rs_sanpham = mysqli_query($conn,$sl_sanpham);
if(!$rs_sanpham) {
    echo "<script language='javascript'>alert('Không thể kết nối !');";
    echo "location.href='index.php';</script>";
}

?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Danh sách sản phẩm </title>
    <?php include_once('header2.php');?>
</header>
<body>
<?php include_once ('header3.php');?>
<!--Content Start Here -->
        <h3 style="text-align: center">DANH SÁCH SẢN PHẨM </h3>
<div style="overflow-x: scroll"> <table class=" table table-bordered hover"  style="overflow-x: scroll" border="2">
        <thead class="text-center">
        <tr>
            <td width=""><strong> STT</strong></td>
            <td width=""><strong> TÊN SẢN PHẨM </strong></td>
            <td width=""><strong> LOẠI </strong></td>
            <td width=""><strong> TÊN NHÃN HIỆU </strong></td>
            <td width=""><strong> GIÁ BÁN </strong></td>
            <td width=""><strong> GIÁ KM</strong></td>
            <td width=""><strong> SỐ LƯỢNG TỒN </strong></td>
            <td width=""><strong> URLHINH </strong></td>
            <td width=""><strong> SLx </strong></td>
            <td width=""><strong> ẨN HIỆN </strong></td>
            <td><a href="them_sp.php" ><strong> THÊM </strong></a></td>
        </tr>
        </thead>
        <?php $stt = 0;?>
        <?php while ($r = $rs_sanpham->fetch_assoc()) {?>
            <tbody>
            <td width=""><strong> <?php echo ++$stt ;?> </strong></td>
            <td width=""><a href="sp_chitiet.php?idSP=<?php echo $r['idSP'];?>" > <strong><?php echo $r['TenSP'];?> </strong></a></td>
            <?php
            $sl_loai = "select TenL from loaisp WHERE idL =".$r['idL'];
            $result_loai = mysqli_query($conn,$sl_loai);
            $r_loai = mysqli_fetch_array($result_loai);
            ?>
            <td width=""><strong><?php echo $r_loai['TenL'];?> </strong></td>
            <?php
            $sl_nh = "select TenNH from nhanhieu WHERE idNH =".$r['idNH'];
            $result_nh = mysqli_query($conn,$sl_nh);
            $r_nh = mysqli_fetch_array($result_nh);
            ?>
            <td width=""><strong><?php echo $r_nh['TenNH'];?> </strong></td>
            <td width=""><strong><?php echo $r['GiaBan'];?> </strong></td>
            <td width=""><strong><?php echo $r['GiaKhuyenmai'];?> </strong></td>
            <td width=""><strong><?php echo $r['SoLuongTonKho'];?> </td>
            <td width=""><strong><?php echo $r['urlHinh'];?> </strong></td>
            <td width=""><strong><?php echo $r['SoLanXem'];?> </strong></td>
            <td width=""><strong><?php if($r['AnHien'] ==1 ) echo "Hiện"; else echo "Ẩn";?> </strong></td>
            <td><a href="sua_xoa_sp.php?idSP=<?php echo $r["idSP"]?>"><strong> SỬA/XÓA </strong></a></td>
            </tbody>
        <?php }?>
    </table></div>



<?php include_once ('footer.php');?>
</body>
</html>

