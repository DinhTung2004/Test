<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 17-Mar-17
 * Time: 23:38
 */?>
<?php include ('../connection/connect_database.php'); ?>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<?php
if(isset($_GET['idBV']))
{
    $sl = "select * from baiviet where idBV=".$_GET['idBV'];
    $result = mysqli_query($conn,$sl);}
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header.php"); ?>
    <title>Mô tả bài viết</title>
    <?php include_once ("header1.php");?>
<!--    <style>-->
<!--        .btn_time {background-image: url("../images/clock.png";)}-->
<!--        .glyphicon.btn_time{background-image: url("../images/clock.png";)}-->
<!--    </style>-->
    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
</header>
<body>
<?php include_once ("header2.php");?>
<div class="container">
    <div style="margin-left: 200px; margin-right: 200px; line-height: 2.5; font-family: Source-Sans-Pro, Arial, sans-serif; background-color: transparent;text-align: justify;">
        <?php while ($r = $result->fetch_assoc()) {?>
            <div class="row">
                <div class="col-md-10"><?php echo $r['TieuDe'];?></div>
            </div>
            <div class="row">
                <div class="col-md-10"><?php echo  $r['NoiDung'];?></div>
            </div>
        <?php }?>

    </div>
</div>

<?php include_once ("footer.php");?>
</body>
</html>

