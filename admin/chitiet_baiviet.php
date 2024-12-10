<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 16-Apr-17
 * Time: 16:18
 */
include_once ('../connection/connect_database.php');
$sl_baiviet = "select * from baiviet WHERE idBV =".$_GET['idBV'];
$rs_baiviet = mysqli_query($conn,$sl_baiviet);
        if(!$rs_baiviet)
            echo "Không thể truy vấn CSDL";
        $row_baiviet = mysqli_fetch_array($rs_baiviet);
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Chi tiết bài viết </title>
    <?php include_once('header2.php');?>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center"><?php echo $row_baiviet['TieuDe'];?></h3>
<div class="row">
    <div class="col-md-10"><img src="../images/<?php echo $row_baiviet['img'];?>"></div>
</div>
<div class="row">
    <div class="col-md-10"><?php echo $row_baiviet['MoTa'];?></div>
</div>
<div class="row" style=" line-height: 2.5; font-family: Source-Sans-Pro, Arial, sans-serif; background-color: transparent;text-align: justify;">
    <div class="col-md-10"><?php echo $row_baiviet['NoiDung'];?></div>
</div>

<?php include_once ('footer.php');?>
</body>
</html>

