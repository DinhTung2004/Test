<?php
/**
 * Created by PhpStorm.
 * User: tu05d
 * Date: 4/19/2017
 * Time: 9:21 PM
 */
?>
<?php
include_once ('../connection/connect_database.php');
if(isset($_POST['HoTen'])&&isset($_POST['noidung'])) {
    $sl = "insert into gopy_lienhe(HoTen,noidung,DienThoai,Email,NgayGui) VALUES ('" . $_POST['HoTen'] . "','" . $_POST['noidung'] . "','" . $_POST['DienThoai'] . "','" . $_POST['Email'] . "','" . $_POST['NgayGui'] . "')";
    $kq = mysqli_query($conn, $sl);
    if ($kq) {
        echo "<script language='javascript'>alert('Thêm thành công');";
        echo "location.href='../site/index.php?index=1';</script>";
    } else
        die("Thêm sai!");

}
else
    echo "Thêm không thành công"
?>
<!DOCTYPE html>
<html>

<header>
    <?php include_once ("header.php");?>
    <title>Trang chủ</title>
    <?php include_once ("header1.php");?>
    <?php include ('../connection/connect_database.php');?>
    <style>
        .box{ border-radius: 2%;}
        .box.hover{border-color: green;}
        .boxsizing {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            width: 180px;
            height: 182px;
            border: 1px solid blue;
        }
        div.row{padding-top: 2%;}
    </style>
    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
    <link rel="stylesheet" href="../css/layout.min.css" type="text/css">
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</header>
<body>
<?php include_once ("header2_index.php");?>
<!---- Nội dung---->
<h3 align="center">Thêm liên hệ</h3>

<form method="post" action="" name="index_Lienhe" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Họ Tên: </strong></div>
        <div class="col-md-9"><input type="text" name="HoTen" placeholder="ví dụ: Nguyễn Văn A" size="50" /></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Nội dung: </strong></div>
        <div class="col-md-9"><textarea id="noidung" name="noidung" cols="" rows=""></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace('noidung');
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Điện thoại: </strong></div>
        <div class="col-md-9"><input type="tel" name="DienThoai" placeholder="ví dụ: 0169999999" size="50" /></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Email: </strong></div>
        <div class="col-md-9"><input type="email" name="Email" placeholder="ví dụ: abc@gmail.com" size="50" /></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ngày gửi: </strong></div>
        <div class="col-md-9"><input type="text" name="NgayGui" readonly="readonly" size="50" value="<?php echo date("Y-m-d");?>"/></div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-9"><input type="submit" name="Them" value="Thêm"/>     <input type="reset" name="Cancel" value="Hủy"/></div>
    </div>

    <?php include_once ("footer.php");?>
</body>
</html>
