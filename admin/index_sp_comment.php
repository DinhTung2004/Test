<?php
/**
 * Created by PhpStorm.
 * User: tu05d
 * Date: 12-Apr-17
 * Time: 23:35
 */
include_once ('../connection/connect_database.php');
$sl_sp_cmt = "select * from sanpham_comment";
$rs_sp_cmt = mysqli_query($conn,$sl_sp_cmt);
if(!$rs_sp_cmt)
    echo "Không thể truy vấn CSDL";?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Sản phẩm comment</title>
    <?php include_once('header2.php');?>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">DANH SÁCH CÁC SẢN PHẨM ĐƯỢC PHẢN HỒI </h3>
<table class=" table table-bordered " border="2">
    <thead class="text-center">
    <tr>
        <td width=""><strong> STT</strong></td>
        <td width=""><strong> MÃ SẢN PHẨM </strong></td>
        <td width=""><strong> HỌ TÊN </strong></td>
        <td width=""><strong> NGÀY </strong></td>
        <td width=""><strong> KIỂM DUYỆT </strong></td>
        <td ><strong> THAO TÁC </strong></a></td>
    </tr>
    </thead>
    <?php $stt = 0;?>
    <?php while ($r = $rs_sp_cmt->fetch_assoc()) {?>
        <tbody>
        <td width=""><strong> <?php echo ++$stt ;?> </strong></td>
        <td width=""><strong><?php echo $r['idSP'];?> </strong></td>
        <td width=""><strong><?php echo $r['hoten'];?> </strong></td>
        <td width=""><strong><?php echo $r['ngay_comment'];?></strong></td>
        <td width=""><strong><?php if($r['kiem_duyet'] == 1 ) echo "Đã xem"; else echo "Chưa xem";?> </strong></td>
        <td><a href="xoa_lsp_cmt.php?idCM=<?php echo $r['id_comment'];?>" ><strong> XÓA </strong></a></td>
        </tbody>
    <?php }?>
</table>

<?php include_once ('footer.php');?>
</body>
</html>
