<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 16:51
 */

include_once ('../connection/connect_database.php');
$sl_loaisp = "select * from loaisp";
$rs_loaisp = mysqli_query($conn,$sl_loaisp);
if(!$rs_loaisp)
    echo "Không thể truy vấn CSDL";?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Danh sách loại sản phẩm</title>
    <?php include_once('header2.php');?>
</header>
<body>
<?php include_once ('header3.php');?>
<!--Content Start Here -->
        <h3 style="text-align: center">DANH SÁCH LOẠI SẢN PHẨM </h3>
        <table class=" table table-bordered " border="2">
            <thead class="text-center">
            <tr>
                <td width="5%"><strong> STT</strong></td>
                <td width="50%"><strong> TÊN LOẠI NƯỚC HOA </strong></td>
                <td width="10%"><strong> THỨ TỰ </strong></td>
                <td width="10%"><strong> ẨN HIỆN </strong></td>
                <td ><a href="them_lsp.php" ><strong> THÊM </strong></a></td>
            </tr>
            </thead>
            <?php $stt = 0;?>
            <?php while ($r = $rs_loaisp->fetch_assoc()) {?>
                <tbody>
                <td width="5%"><strong> <?php echo ++$stt ;?> </strong></td>
                <td width="50%"><strong><?php echo $r['TenL'];?> </strong></td>
                <td width="10%"><strong><?php echo $r['ThuTu'];?> </strong></td>
                <td width="10%"><strong><?php if($r['AnHien'] ==1 ) echo "Hiện"; else echo "Ẩn";?> </strong></td>
                <td><a href="sua_lsp.php?idL= <?php echo $r['idL'];?>" ><strong> SỬA/XÓA </strong></a></td>
                </tbody>
            <?php }?>
        </table>

<?php include_once ('footer.php');?>
</body>
</html>


