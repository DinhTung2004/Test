<?php
?>
<!DOCTYPE html>
<header>
    <?php include_once("../connection/connect_database.php");
    include_once("header1.php"); ?>
    <title>Thêm sản phẩm</title>
    <?php include_once('header2.php'); ?>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <style>
        div.row {
            padding-top: 2%;
        }
    </style>
</header>

<body>
    <?php include_once('header3.php'); ?>
    <!-- Nội dung ở đây -->
    <center>
        <h3>Thêm sản phẩm mới</h3>
    </center>
    <form method="post" action="" name="ThemSP" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-2"><strong>Tên sản phẩm</strong></div>
            <div class="col-md-9"><input type="text" name="TenSP" id="TenSP"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Nhãn hiệu</strong></div>
            <?php $sl_nhanhieu = "select * from nhanhieu";
            $rs_nhanhieu = mysqli_query($conn, $sl_nhanhieu);
            if (!$rs_nhanhieu) {
                echo "<script language='javascript'>alert('Không thể kết nối !');";
                echo "location.href='index_ds_sp.php';</script>";
            } ?>
            <div class="col-md-9">
                <select id="idNH" name="idNH">
                    <?php while ($r = $rs_nhanhieu->fetch_assoc()) { ?>
                        <option value="<?php echo $r["idNH"]; ?>"> <?php echo $r['TenNH']; ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Loại nước hoa</strong></div>
            <div class="col-md-9">
                <?php
                $sl_l = "select * from loaisp";
                $rs_l = mysqli_query($conn, $sl_l);
                if (!$rs_l) {
                    echo "<script language='javascript'>alert('Không thể kết nối !');";
                    echo "location.href='index_ds_sp.php';</script>";
                } ?>
                <select id="idL" name="idL">
                    <?php while ($row_l = $rs_l->fetch_assoc()) { ?>
                        <option value="<?php echo $row_l["idL"]; ?>"> <?php echo $row_l['TenL']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Giá bán</strong></div>
            <div class="col-md-9"><input type="number" id="Gia-Ban" name="GiaBan" value="0"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Giá khuyến mãi</strong></div>
            <div class="col-md-9"><input type="number" id="GiaKhuyenmai" name="GiaKhuyenmai" value="0"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Số lượng trong kho</strong></div>
            <div class="col-md-9"><input type="number" id="SoLuongTonKho" name="SoLuongTonKho" value="0"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Hình đại diện</strong></div>
            <div class="col-md-9">
                <input type="hidden" name="MAX_FILE_SIZE" value="200000">
                <label> Mời bạn chọn hình</label>
                <div><input type="file" name="file" id="file"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2"><strong>Số lượng đã xem</strong></div>
            <div class="col-md-9"><input type="number" id="SoLanXem" name="SoLanXem" value="0"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Số lần mua</strong></div>
            <div class="col-md-9"><input type="number" id="SoLanMua" name="SoLanMua" value="0"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Ghi Chú</strong></div>
            <div class="col-md-9"><input type="text" id="GhiChu" name="GhiChu"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Mô tả </strong></div>
            <div class="col-md-9"><textarea id="MoTa" name="MoTa" cols="" rows=""></textarea></div>
            <script type="text/javascript">
                CKEDITOR.replace('MoTa');
            </script>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Ngày cập nhật</strong></div>
            <div class="col-md-9"><input type="text" id="NgayCapNhat" name="NgayCapNhat" disabled
                    value="<?php echo date("Y-m-d"); ?>"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
            <div class="col-md-9">
                <select id="AnHien" name="AnHien">
                    <option value="0"><strong>Ẩn</strong></option>
                    <option value="1"><strong>Hiện</strong></option>
                </select>
            </div>
        </div>
        <div class=" row">
            <div class=" col-md-4 col-md-offset-4">
                <input name="Ok" id="Ok" type="submit" value="Ok" />
                <input type="button" id="Huy" name="Huy" value="Hủy" onclick="getConfirmation()" ;>
            </div>
        </div>
    </form>


    <script type="text/javascript">
        <!--
        function getConfirmation() {
            var retVal = confirm("Bạn có muốn hủy ?");
            if (retVal == true) {
                window.history.back();
            }
        }
        //
        -->
    </script>


    <?php include_once('footer.php'); ?>

</body>

</html>
<?php
$ngaytao = date("Y-m-d");
if (isset($_POST["Ok"]) && isset($_POST['TenSP'])) {
    if ($_FILES['file']['name'] != null) {

        /*if (($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "image/bmp"))
        {*/
        /*file hợp lệ và tiến hành upload*/
        $path = '../images/'; // file lưu vào thư mục images
        $tmp_name = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $size = $_FILES['file']['size'];
        if (file_exists($path . $_FILES["file"]["name"])) // dò trùng ảnh trong folder
        {
            echo "<script language='javascript'>alert('Tên ảnh đã tồn tại!');</script>";
        } else {
            $sql_them = "insert into sanpham (idNH,idL,TenSP,NgayCapNhat,MoTa,GiaBan,urlHinh,GiaKhuyenmai,SoLanXem,SoLuongTonKho,GhiChu,SoLanMua,AnHien)
                values(" . $_POST['idNH'] . "," . $_POST['idL'] . ",'" . $_POST['TenSP'] . "','" . $ngaytao . "','" . $_POST['MoTa'] . "'," . $_POST['GiaBan'] . ",
               '" . $name . "',
             " . $_POST['GiaKhuyenmai'] . "," . $_POST['SoLanXem'] . "," . $_POST['SoLuongTonKho'] . ",'" . $_POST['GhiChu'] . "',
             " . $_POST['SoLanMua'] . "," . $_POST['AnHien'] . ")";
            $rs_themsp = mysqli_query($conn, $sql_them);
            if ($rs_themsp) {
                // upload file
                move_uploaded_file($tmp_name, $path . $name);
                echo "<script language='javascript'>alert('Thêm thành công!');";
                echo "location.href='index_ds_sp.php';</script>";
            } else {
                echo "<script language='javascript'>alert('Thêm không thành công!');</script>";
            }
        }

        /* } else echo "<script language='javascript'>alert('Định dạng file không hợp lệ');</script>";*/
    } else echo "<script language='javascript'>alert('Bạn chưa chọn hình');</script>";
}
?>