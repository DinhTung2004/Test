<?php

?>
<?php
session_start();
include("../connection/connect_database.php");
if (isset($_POST['Username']) && isset($_POST['Password'])) {
    $username = $_POST['Username'];
    $password = md5($_POST['Password']);
    //xóa tag html và ký tự đặc biệt
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);
    if ($username == "" || $password = "")
        echo "Username và password không được để trống!";
    else {
        $sql = "select * from Users where HoTen='" . $_POST['Username'] . "' and Password='" . md5($_POST['Password']) . "'";
        $query = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows > 0) {
            //lưu tên đăng nhập vào session
            $_SESSION['Username'] = $username;
            $r_us = mysqli_fetch_array($query);
            $_SESSION['HoTenK'] = $r_us['HoTenK'];
            $_SESSION['IDUser'] = $r_us['idUser'];
            $_SESSION['SDT'] = $r_us['DienThoai'];
            $_SESSION['DC'] = $r_us['DiaChi'];
            $_SESSION['Email'] = $r_us['Email'];
            if ($_SESSION['IDUser'] == 1) {
                echo "<script language='javascript'>alert('Đăng nhập thành công! Xin chào " . $r_us['HoTenK'] . "');";
                echo "location.href='../admin/index.php';</script>";
            } else {
                echo "<script language='javascript'>alert('Đăng nhập thành công! Xin chào " . $r_us['HoTenK'] . "');";
                if (isset($_SESSION['cart']))
                    echo "location.href='GioHang.php?idSP=1';</script>";
                else
                    echo "location.href='index.php';</script>";
            }
        } else {
            echo "<script language='javascript'>alert('Đăng nhập thất bại!');";
            echo "location.href='DangNhap.php';</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header.php"); ?>
    <title>Trang chủ</title>
    <?php include_once("header1.php"); ?>
</header>

<body>
    <?php include_once("header2.php"); ?>
    <!---- Nội dung---->
    <div class="row">
        <marquee behavior="scroll" bgcolor=""><img src="../images/welcome.gif" height="130" width="340" /></marquee>
    </div>
    <div style="background-image: url(../images/banner-nuoc-hoa.jpg); background-repeat: no-repeat;">
        <form method="post" action="DangNhap.php">
            <div
                style="font-size: 150%; font-family: 'Helvetica Neue', helvetica, arial, sans-serif; color: #0e0079; text-align: center; margin-left: 50px;">
                <b>Đăng Nhập</b>
            </div>
            <br />
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3"
                    style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align: center; ">
                    <b><i></i></b>
                </div>
                <div class="col-md-6" style="color: red;">
                    <input type="text" style="border-radius: 5px; color: black;" size="30" name="Username" id="Username"
                        placeholder="ví dụ: abc" autofocus="autofocus" maxlength="50"
                        value="<?php if (isset($_POST['Username'])) echo $username; ?>"> (*)
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3"
                    style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;text-align: center;">
                    <b><i></i></b>
                </div>
                <div class="col-md-6" style="color: red;">
                    <input type="password" style="border-radius: 5px; color: black;" size="30" name="Password"
                        id="Password" placeholder="Nhập password"> (*)
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <button id="Submit" name="Submit" class="btn btn-success">Đăng nhập</button>
                    <button class="btn btn-success"><a style="text-decoration: none; color: #FFFFFF;"
                            href="../site/index.php">Thoát</a></button>
                </div>
            </div>
            <br /><br /><br />
        </form>
    </div>
    <?php include_once("footer.php"); ?>
</body>

</html>