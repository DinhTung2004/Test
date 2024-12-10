<?php
session_start();
ob_start();
/**
 * Created by PhpStorm.
 * User: tu05d
 * Date: 5/15/2017
 * Time: 12:03 AM
 */
include_once ('../connection/connect_database.php');
if(isset($_SESSION['IDUser'])) {
    $sl = "select * from Users where idUser=".$_SESSION['IDUser'];
    $kq = mysqli_query($conn, $sl);
    $d=mysqli_fetch_array($kq);
    if (isset($_POST['Sua'])) {
        $sql = "select * from Users ";
        $query = mysqli_query($conn, $sql);
        $thongbao = "";

        if ($_POST['Username'] != "" && $_POST['Password_old'] != "" && $_POST['Password'] != "" && $_POST['Password_1'] != "" && $_POST['DienThoai'] != "") {
            if (md5($_POST["Password_old"]) != $d['Password']) {
                $thongbao = $thongbao . "Mật khẩu không chính xác ";
            }
            while ($r = $query->fetch_assoc()) {
                if ($r['HoTen'] == $_POST['Username'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Username đã tồn tại ';
                if ($r['Email'] == $_POST['Email'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Email đã tồn tại ';
                if ($r['DienThoai'] == $_POST['DienThoai'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Số điện thoại đã tồn tại ';
            }
            if (md5($_POST['Password']) != md5($_POST['Password_1'])) {
                $thongbao = $thongbao . "Mật khẩu không trùng khớp ";
            }
            if ($thongbao != "") {
                echo "<script language='javascript'>alert('$thongbao');</script>";
            } else {
                $sl1 = "update Users set HoTen='" . $_POST['Username'] . "',
                HoTenK='" . $_POST['HoTenK'] . "',
                Password='" .md5($_POST['Password']). "',
                DiaChi='" . $_POST['DiaChi'] . "',
                DienThoai='" . $_POST['DienThoai'] . "',
                Email='" . $_POST['Email'] . "',
                NgayDangKy='" . $_POST['NgayDangKy'] . "'
                where HoTen='".$_SESSION['Username']."'";
                $kq1 = mysqli_query($conn, $sl1);
                if ($kq1) {
                    echo "<script language='javascript'>alert('Sửa thành công');";
                    echo "location.href='../site/index.php';</script>";
                }
            }
        } else
            echo "<script language='javascript'>alert('Vui lòng nhập đầy đủ thông tin!!!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header.php");?>
    <title>Trang chủ</title>
    <?php include_once ("header1.php");?>
</header>
<body>
<?php include_once ("header2.php");?>
<!---- Nội dung---->
<form action="Sua_TaiKhoan.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-5"></div>
            <div  class="col-md-7" style="font-size:150%; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b>SỬA TÀI KHOẢN</b></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3"  style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Username:</strong></div>
            <div class="col-md-6" style="color: red;"><input style="border-radius: 5px; color: black;" type="text" name="Username" placeholder="ví dụ: abc" size="50" value="<?php echo $_SESSION['Username'];?>"/></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Họ và tên: </i></b></div>
            <div  class="col-md-6" style="color: red;">
                <input type="text" style="border-radius: 5px; color: black;"   size="30" name="HoTenK" id="HoTenK" placeholder="ví dụ: Nguyễn Thị A" value="<?php echo $_SESSION['HoTenK'];?>" > (*)
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Password cũ:</strong></div>
            <div class="col-md-6" style="color: red;"><input style="border-radius: 5px; color: black;" type="password" name="Password_old" placeholder="Nhập password cũ" size="50"/>(*)</div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Password mới:</strong></div>
            <div class="col-md-6" style="color: red;"><input style="border-radius: 5px; color: black;" type="password" name="Password" placeholder="Nhập password mới" size="50"/>(*)</div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Nhập lại Password:</strong></div>
            <div class="col-md-6" style="color: red;"><input style="border-radius: 5px; color: black;" type="password" name="Password_1" placeholder="Nhập lại password mới" size="50"/>(*)</div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Địa chỉ:</strong></div>
            <div class="col-md-6" style="color: red;"><input style="border-radius: 5px; color: black;" type="text" name="DiaChi" placeholder="Ví dụ: TpHCM, Quảng Ngãi" size="50" value="<?php echo $d['DiaChi'];?>"/></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Điện thoại: </strong></div>
            <div class="col-md-6" style="color: red;"><input style="border-radius: 5px; color: black;" type="tel" name="DienThoai" placeholder="ví dụ: 0965555555" maxlength="13"size="50" value="<?php echo $d['DienThoai'];?>"/></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Email: </strong></div>
            <div class="col-md-6" style="color: red;"><input style="border-radius: 5px; color: black;" type="email" name="Email" placeholder="ví dụ: abc@gmail.com" size="50" value="<?php echo $d['Email'];?>" /></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Ngày đăng ký: </strong></div>
            <div class="col-md-6"><input style="border-radius: 5px; color: black;" type="text" name="NgayDangKy" readonly="readonly" size="50" value="<?php echo $d['NgayDangKy'];?>"/></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6"><button id="Sua" name="Sua"  class="btn btn-success">Sửa</button>   <button class="btn btn-success"><a style="text-decoration: none; color: #FFFFFF;" href="../site/index.php">Thoát</a></button> </div>
        </div>
    </div>
</form>
<?php include_once ("footer.php");?>
