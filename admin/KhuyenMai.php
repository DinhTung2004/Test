<?php
/**
 * Created by PhpStorm.
 * User: tu05d
 * Date: 5/20/2017
 * Time: 12:32 PM
 */
include_once ('../connection/connect_database.php');
$sl_km = "select * from khuyenmai";
$rs_km = mysqli_query($conn,$sl_km);
if(!$rs_km)
    echo "Không thể truy vấn CSDL";
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Chương trình khuyến mãi </title>
    <?php include_once('header2.php');?>
    <link href="../css/hieuung.css"  type="text/css" rel="stylesheet">
</header>
<body >
<?php include_once ('header3.php');?>
<div style="overflow-x: scroll"> <table class=" table table-bordered hover"  style="overflow-x: scroll" border="2">
        <thead class="text-center">
        <tr>
            <td width=""><strong> STT</strong></td>
            <td width=""><strong> MÔ TẢ KHUYẾN MÃI </strong></td>
            <td width=""><strong> URL HÌNH</strong></td>
            <td width=""><strong> ẨN HIỆN</strong></td>
            <td COLSPAN="2"><a href="them_km.php" ><strong> THÊM </strong></a></td>
        </tr>
        </thead>
        <?php $stt = 0;?>
        <?php while ($r = $rs_km->fetch_assoc()) {?>
            <tbody>
            <td width=""><strong> <?php echo ++$stt ;?> </strong></td>
            <td width=""><strong><?php echo $r['MotaKM'];?> </strong></td>
            <td width=""><strong><?php echo $r['urlHinh'];?> </strong></td>
            <td width=""><strong><?php echo $r['AnHien'];?> </strong></td>
            <td><a href="sua_km.php?idKM=<?php echo $r['idKM'];?>" ><strong> SỬA </strong></a></td>
            <td><a href="xoa_km.php?idKM=<?php echo $r['idKM'];?>"><strong> XÓA </strong></a></td>
            </tbody>
        <?php }?>
    </table></div>
<?php include_once ('footer.php');?>
</body>
</html>
