<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 16-Apr-17
 * Time: 17:23
 */?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("../connection/connect_database.php"); include_once ("header1.php");?>
    <title>Thêm bài viết </title>
    <?php include_once('header2.php');?>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <style> div.row {padding-top: 2%;}</style>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">Thêm bài viết </h3>
<form  method="post" action="" name="ThemBaiViet" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên sản phẩm: </strong></div>
        <?php $sl_sanpham = "select * from sanpham";
        $rs_sanpham = mysqli_query($conn,$sl_sanpham);
        if(!$rs_sanpham)
            echo "Không thể truy vấn CSDL";?>
        <div class="col-md-9">
            <select name="idSP">
                <?php while ($r = $rs_sanpham->fetch_assoc()) {?>
                    <option value="<?php echo $r["idSP"];?>"> <?php echo $r['TenSP'];?> </option>
                <?php }?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Tiêu đề</strong></div>
        <div class="col-md-9"><input type="text" name="TieuDe" value=""></div>
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
        <div class="col-md-2"><strong>Mô tả ngắn:  </strong></div>
        <div class="col-md-9"><textarea name="MoTa" cols="" rows="" ></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace( 'MoTa' );
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Nội dung </strong></div>
        <div class="col-md-9"><textarea name="NoiDung" cols="" rows="" ></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace( 'NoiDung' );
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ngày cập nhật</strong></div>
        <div class="col-md-9"><input type="text" name="NgayCapNhat" readonly="readonly" value="<?php echo date("Y-m-d h:i:s");?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong></strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <option value="0"> <strong>Ẩn</strong></option>
                <option value="1"> <strong>Hiện</strong></option>

            </select>
        </div>
    </div>
    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input name="Ok" type="submit" value="Ok" />
            <input type="button" name="Huy" value="Hủy" onclick="getConfirmation()";>
        </div>
    </div>
</form>


<script type="text/javascript">
    <!--
    function getConfirmation(){
        var retVal = confirm("Bạn có muốn hủy ?");
        if( retVal == true ){
            window.history.back();
        }
    }
    //-->
</script>

<?php
if(isset($_POST['Ok']) &&isset($_POST['NoiDung'])&& isset($_POST['TieuDe']) && isset($_POST['MoTa'])) {
        if ($_FILES['file']['name'] != null) {
        }
        $path = '../images/';
        // file lưu vào thư mục images
        $tmp_name = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $size = $_FILES['file']['size'];
        if (file_exists($path . $_FILES["file"]["name"]))// dò trùng ảnh trong folder
        {
            echo "<script language='javascript'>alert('Tên ảnh đã tồn tại!');</script>";
        }
        else {
            $q_baiviet = "insert into baiviet (idSP,TieuDe,NoiDung,NgayCapNhat,AnHien,Mota,img) VALUES (" . $_POST['idSP'] . ",N'" . $_POST['TieuDe'] . "',
            '" . $_POST['NoiDung'] . "','" . $_POST['NgayCapNhat'] . "'," . $_POST['AnHien'] . ",N'" . $_POST['MoTa'] . "','".$name."')";
            $rs = mysqli_query($conn, $q_baiviet);
            if ($rs) {
                // upload file
                move_uploaded_file($tmp_name, $path . $name);
                echo "<script language='javascript'>alert('Them thanh cong');";
                echo "location.href = 'baiviet.php';</script>";
            } else
                echo "<script language='JavaScript'> alert('Thêm  không thành công!');</script>";
        }

}
?>

<?php include_once ('footer.php');?>
</body>
</html>
