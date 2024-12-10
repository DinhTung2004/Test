<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 17:19
 */

include_once ('../connection/connect_database.php');
$sl_thanhtoan = "select * from phuongthucthanhtoan";
$rs_thanhtoan = mysqli_query($conn,$sl_thanhtoan);
if(!$rs_thanhtoan)
    echo "Không thể truy vấn CSDL";?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Phương thức thanh toán </title>
    <?php include_once('header2.php');?>
</header>
<body>
<?php include_once ('header3.php');?>
<!--Content Start Here -->
<h3 style="text-align: center">DANH SÁCH THANH TOÁN </h3>
<table class=" table table-bordered " border="2">
    <thead class="text-center">
    <tr>
        <td width=""><strong> STT</strong></td>
        <td width=""><strong> TÊN PT Thanh Toán </strong></td>
        <td width=""><strong> Ghi chú </strong></td>
        <td width=""><strong> Ẩn Hiện </strong></td>
        <td><a href="them_pttt.php?idPTTT=<?php echo $r['idPTTT'];?>" ><strong> THÊM </strong></a></td>
    </tr>
    </thead>
    <?php $stt = 0;?>
    <?php while ($r = $rs_thanhtoan->fetch_assoc()) {?>
        <tbody>
        <td width="5%"><strong> <?php echo ++$stt ;?> </strong></td>
        <td width="30%"><strong><?php echo $r['TenPhuongThucTT'];?> </strong></td>
        <td width="30%"><strong><?php echo $r['GhiChu'];?> </strong></td>
        <td width="10%"><strong><?php if($r['AnHien'] ==1 ) echo "Hiện"; else echo "Ẩn";?> </strong></td>
        <td><a href="sua_xoa_pttt.php?idPTTT=<?php echo $r['idPTTT'];?>" ><strong> SỬA/XÓA </strong></a></td>
        </tbody>
    <?php }?>
</table>

<?php include_once ('footer.php');?>
</body>
</html>
