<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 17:19
 */

include_once ('../connection/connect_database.php');
$sl_giaohang = "select * from phuongthucgiaohang";
$rs_giaohang = mysqli_query($conn,$sl_giaohang);
if(!$rs_giaohang)
    echo "Không thể truy vấn CSDL";?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Phương thức giao hàng </title>
    <?php include_once('header2.php');?>
</header>
<body>
<?php include_once ('header3.php');?>
<!--Content Start Here -->
<h3 style="text-align: center">DANH SÁCH GIAO HÀNG </h3>
<table class=" table table-bordered " border="2">
    <thead class="text-center">
    <tr>
        <td width=""><strong> STT</strong></td>
        <td width=""><strong> TÊN GIAO HÀNG </strong></td>
        <td width=""><strong> Phí </strong></td>
        <td width=""><strong> Ẩn Hiện </strong></td>

        <td><a href="them_ph_giaohang.php?idGH=<?php echo $r['idGH'];?>" ><strong> THÊM </strong></a></td>
    </tr>
    </thead>
    <?php $stt = 0;?>
    <?php while ($r = $rs_giaohang->fetch_assoc()) {?>
        <tbody>
        <td width="5%"><strong> <?php echo ++$stt ;?> </strong></td>
        <td width="30%"><strong><?php echo $r['TenGH'];?> </strong></td>
        <td width="30%"><strong><?php echo $r['Phi'];?> </strong></td>
        <td width="10%"><strong><?php if($r['AnHien'] ==1 ) echo "Hiện"; else echo "Ẩn";?> </strong></td>
        <td><a href="sua_xoa_gh.php?idGH=<?php echo $r['idGH'];?>" ><strong> SỬA/XÓA </strong></a></td>
        </tbody>
    <?php }?>
</table>

<?php include_once ('footer.php');?>
</body>
</html>
