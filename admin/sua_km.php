<?php
/**
 * Created by PhpStorm.
 * User: tu05d
 * Date: 5/20/2017
 * Time: 12:38 PM
 */
include_once ('../connection/connect_database.php');
$sl_km="select * from khuyenmai where idKM=".$_GET['idKM'];
$kq_km=mysqli_query($conn,$sl_km);
$d=mysqli_fetch_array($kq_km);
if(isset($_POST['Sua'])) {
    if(isset($_FILES['file'])){

        if($_FILES['file']['name'] !=null)
        {
            if(($_FILES['file']['type']=="image/gif")||($_FILES['file']['type']=="image/jpeg")||($_FILES['file']['type']=="image/jpg")||($_FILES['file']['type']=="image/png")&&($_FILES['file']['size']<=2500))
            {
                $path_image="../images/".$_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'],$path_image);
            }
        }else
            echo "<script>alert('Tên file không hợp lệ!');</script>";

    }
    $hinh = $_FILES['file']['name'];
    $sl_km = "update khuyenmai
              set MotaKM='". $_POST['Mota'] . "',
              urlHinh='" . $hinh . "',
              AnHien='" . $_POST['AnHien'] . "'
              where idKM=".$_GET['idKM'];
    $kq_km = mysqli_query($conn, $sl_km);
    if ($kq_km) {
        echo "<script language='javascript'>alert('Sửa thành công');";
        echo "location.href='../admin/KhuyenMai.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Sửa khuyến mãi </title>
    <?php include_once('header2.php');?>
    <style>div.row {
            padding-top: 2%;
        }</style>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">Sửa khuyến mãi</h3>
<form method="post" action="" name="sua_km" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Mô tả:</strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;"type="text" name="Mota" size="50" value="<?php echo $d['MotaKM'];?>"/>(*)</div>
    </div>
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>UrlHinh:</strong></div>
        <div class="col-md-9" style="color: red;"><img src="../images/<?php echo $d['urlHinh'];?>"/><input style="border-radius: 5px; color: black;" type="file" name="file" size="50" value="<?php echo $d['urlHinh'];?>" />(*)</div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <option value="0" <?php if ($d['AnHien'] == 0) echo "selected"; ?>><strong>Ẩn</strong></option>
                <option value="1" <?php if ($d['AnHien'] == 1) echo "selected"; ?>><strong>Hiện</strong>
                </option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-9"><button id="Sua" name="Sua"  class="btn btn-success">Sửa KM</button>  <button class="btn btn-success"><a style="text-decoration: none; color: #FFFFFF;" href="../admin/KhuyenMai.php">Thoát</a></button></div>
    </div>
</form>
