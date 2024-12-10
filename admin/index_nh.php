<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 17:19
 */

include_once ('../connection/connect_database.php');
$sl_nhanhieu = "select * from nhanhieu";
$rs_nhanhieu = mysqli_query($conn,$sl_nhanhieu);
if(!$rs_nhanhieu)
echo "Không thể truy vấn CSDL";?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Danh sách nhãn hiệu </title>
    <?php include_once('header2.php');?>
</header>
<body>
<?php include_once ('header3.php');?>
<!--Content Start Here -->
<h3 style="text-align: center">DANH SÁCH CÁC NHÃN HIỆU CỦA NƯỚC HOA  </h3>
<table class=" table table-bordered " border="2">
    <thead class="text-center">
    <tr>
        <td width=""><strong> STT</strong></td>
        <td width=""><strong> TÊN NHÃN HIỆU </strong></td>
        <td width=""><strong> LOẠI </strong></td>
        <td width=""><strong> THỨ TỰ </strong></td>
        <td width=""><strong> ẨN HIỆN </strong></td>
        <td ><a href="them_nh.php" ><strong> THÊM </strong></a></td>
    </tr>
    </thead>
    <?php $stt = 0;?>
    <?php while ($r = $rs_nhanhieu->fetch_assoc()) {?>
        <tbody>
        <td width="5%"><strong> <?php echo ++$stt ;?> </strong></td>
        <td width="50%"><strong><?php echo $r['TenNH'];?> </strong></td>
        <?php
        $sl_loai = "select TenL from loaisp WHERE idL =".$r['idL'];
        $result_loai = mysqli_query($conn,$sl_loai);
        $r_loai = mysqli_fetch_array($result_loai);
        ?>
        <td width="50%"><strong><?php echo $r_loai['TenL'];?> </strong></td>
        <td width="10%"><strong><?php echo $r['ThuTu'];?> </strong></td>
        <td width="10%"><strong><?php if($r['AnHien'] ==1 ) echo "Hiện"; else echo "Ẩn";?> </strong></td>
        <td><a href="sua_xoa_nh.php?idNH=<?php echo $r['idNH'];?>" ><strong> SỬA/XÓA </strong></a></td>
        </tbody>
    <?php }?>
</table>

<?php include_once ('footer.php');?>
</body>
</html>



