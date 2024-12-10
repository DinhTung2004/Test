<?php
/**
 * Created by PhpStorm.
 * User: tu05d
 * Date: 5/14/2017
 * Time: 10:32 AM
 */
if(!isset($_SESSION))
{
    session_start();ob_start();
}

include_once ('../connection/connect_database.php');
if(isset($_POST['TaoTK'])){
    if ($_POST['Username']!=""&& $_POST['Password']!="" && $_POST['Password1']!="" && $_POST['DiaChi']!="" && $_POST['DienThoai']!="") {
        $sql = "select * from users";
        $query = mysqli_query($conn, $sql);
        $thongbao = "";
        while ($r = $query->fetch_assoc()) {
            if ($r['HoTen'] == $_POST['Username'])
                $thongbao = $thongbao . 'Username đã tồn tại ';
            if ($r['Email'] == $_POST['Email']&&$_POST['Email']!="")
                $thongbao = $thongbao . 'Email đã tồn tại ';
            if ($r['DienThoai'] == $_POST['DienThoai'])
                $thongbao = $thongbao . 'Số điện thoại đã tồn tại ';
        }
        if (md5($_POST['Password']) !=md5( $_POST['Password1'])){
            $thongbao = $thongbao . 'Mật khẩu không trùng khớp';
        }
        if ($thongbao != "") {
            echo "<script language='javascript'>alert('$thongbao');</script>";
        } else {

            $sl = "insert into users(HoTen,HoTenK,Password,DiaChi,DienThoai,Email,NgayDangKy,idGroup) VALUES ('" . $_POST['Username'] . "','" . $_POST['HoTenK'] . "','" .md5( $_POST['Password'] ). "','" . $_POST['DiaChi'] . "','" . $_POST['DienThoai'] . "','" . $_POST['Email'] . "','" . $_POST['NgayDangKy'] . "',2)";
            $kq = mysqli_query($conn, $sl);
            if ($kq) {
                echo "<script language='javascript'>alert('Thêm thành công');";
                $sql = "select idUser from Users where HoTen='" . $_POST['Username'] . "'";
                $query = mysqli_query($conn, $sql);
                $d=mysqli_fetch_array($query);
                $_SESSION['Username'] = $_POST['Username'];
                $_SESSION['HoTenK'] = $_POST['HoTenK'];
                $_SESSION['IDUser'] = $d['idUser'];
                $_SESSION['SDT'] = $_POST['DienThoai'];
                $_SESSION['DC'] = $_POST['DiaChi'];
                $_SESSION['Email'] = $_POST['Email'];
                echo "location.href='../site/index.php?index=1';</script>";
            }
            else
                echo "<script language='javascript'>alert('$thongbao');</script>";
        }
    }
    else
        echo "<script language='javascript'>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
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
<form action="TaoTaiKhoan.php" method="post">
<div class="container">
    <div class="row">
        <div class="col-md-5"></div>
        <div  class="col-md-7" style="font-size:150%; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b>TẠO TÀI KHOẢN</b></div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3"></div>
        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Username: </i></b></div>
        <div  class="col-md-6" style="color: red;">
            <input type="text" style="border-radius: 5px; color: black;"   size="30" name="Username" id="Username" placeholder="ví dụ: abc" > (*)
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3"></div>
        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Họ và tên: </i></b></div>
        <div  class="col-md-6" style="color: red;">
            <input type="text" style="border-radius: 5px; color: black;"   size="30" name="HoTenK" id="HoTenK" placeholder="ví dụ: Nguyễn Thị A" > (*)
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3"></div>
        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Password: </i></b></div>
        <div class="col-md-6" style="color: red;">
            <input type="password" style="border-radius: 5px; color: black;" size="30" name="Password" id="Password" placeholder="Nhập password" > (*)
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3"></div>
        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Confirm Password: </i></b></div>
        <div class="col-md-6" style="color: red;">
            <input type="password" style="border-radius: 5px; color: black;"  size="30" name="Password1" id="Password1" placeholder="Nhập lại password" > (*)
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3"></div>
        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Địa chỉ: </i></b></div>
        <div class="col-md-6" style="color: red;">
            <input type="text" style="border-radius: 5px; color: black;"  size="30" name="DiaChi" id="DiaChi" placeholder="Ví dụ: TpHCM, Quảng Ngãi">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3"></div>
        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Điện thoại: </i></b></div>
        <div class="col-md-6" style="color: red;">
            <input type="tel" style="border-radius: 5px; color: black;" size="30" name="DienThoai" id="DienThoai" placeholder="ví dụ: 0965555555" >(*)
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3"></div>
        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Email: </i></b></div>
        <div class="col-md-6" style="color: red;">
            <input type="email" style="border-radius: 5px; color: black;"   size="30" name="Email" id="Email" placeholder="ví dụ: abc@gmail.com">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3"></div>
        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Ngày đăng ký: </i></b></div>
        <div class="col-md-6" style="color: red;">
            <input type="text" style="border-radius: 5px; color: black;"  readonly="readonly" size="30" name="NgayDangKy" id="NgayDangKy" value="<?php echo date("Y-m-d h:i:s");?>">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-6"></div>
        <div  class="col-md-6" ><button id="TaoTK" name="TaoTK"  class="btn btn-success">Tạo tài khoản</button>  <button class="btn btn-success"><a style="text-decoration: none; color: #FFFFFF;" href="../site/index.php?index=1">Thoát</a></button></div>
    </div>
    <br/>
</div>
</div>
</form>
<?php include_once ("footer.php");?>
<?php





?>
</body>
</html>

