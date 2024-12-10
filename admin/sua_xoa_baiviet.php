<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 16-Apr-17
 * Time: 17:24
 */?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");include_once ("../connection/connect_database.php");
    $sl_baiviet = "select * from baiviet where idBV =".$_GET['idBV'];
        $rs_baiviet = mysqli_query($conn,$sl_baiviet);
        $row_bv = mysqli_fetch_array($rs_baiviet);
        if(!$rs_baiviet)
        {
            echo "<script language='javascript'>alert('Không thể kết nối !');";
            echo "location.href='baiviet.php';</script>";
        }
    ?>
    <title>Sửa Xóa giao hàng </title>
    <?php include_once('header2.php');?>
    <style> div.row { padding-top: 2%;}</style>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">CẬP NHẬT BÀI VIẾT </h3>
<form  method="post" action="" name="CapNhatBaiViet" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên sản phẩm: </strong></div>
        <?php $sl_sanpham = "select * from sanpham";
        $rs_sanpham = mysqli_query($conn,$sl_sanpham);
        if(!$rs_sanpham)
        {
            echo "<script language='javascript'>alert('Không thể kết nối !');";
            echo "location.href='baiviet.php';</script>";
        }?>
        <div class="col-md-9">
            <select name="idSP">
                <?php while ($r = $rs_sanpham->fetch_assoc()) {?>
                    <option value="<?php echo $r["idSP"]; if($r["idSP"] ==$_GET['idBV']) echo "selected";?>"> <?php echo $r['TenSP'];?> </option>
                <?php }?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Tiêu đề</strong></div>
        <div class="col-md-9"><input type="text" name="TieuDe" value="<?php echo $row_bv['TieuDe'];?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Mô tả ngắn</strong></div>
        <div class="col-md-9"><textarea name="MoTa" cols="" rows=""><?php echo $row_bv['MoTa'];?></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace( 'MoTa');
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Hình đại diện</strong></div>
        <div class="col-md-9">
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000">
            <div>Hình hiện tại: <input type="text" readonly name="img" value="<?php echo $row_bv['img']; ?>">
            </div>

            <div><label>Thay đổi ảnh: </label><input type="file" name="file"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Nội dung </strong></div>
        <div class="col-md-9"><textarea name="NoiDung" cols="" rows=""><?php echo $row_bv['NoiDung'];?></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace( 'NoiDung');
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ngày cập nhật</strong></div>
        <div class="col-md-9"><input type="text" name="NgayCapNhat" readonly="readonly" value="<?php echo $row_bv['NgayCapNhat'];?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong></strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <?php if($row_bv['AnHien'] == 0)?>
                <option value="0" <?php if($row_bv['AnHien'] == 0) echo "selected";?>> <strong>Ẩn</strong></option>
                <option value="1" <?php if($row_bv['AnHien'] == 1) echo "selected";?>> <strong>Hiện</strong></option>

            </select>
        </div>
    </div>
    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input name="update" type="submit" value="Cập nhật" />
            <input name="delete" type="submit" value="Xóa"/>
            <input type="button" name="Huy" value="Trở về" onclick="getConfirmation()";>
        </div>
    </div>
</form>


<script type="text/javascript">
    <!--
    function getConfirmation(){
        var retVal = confirm("Bạn có muốn trở về không ?");
        if( retVal == true ){
            window.history.back();
        }
    }
    //-->
</script>

<?php include_once ('footer.php');?>
</body>
</html>
<?php
$ngaycapnhat = date('Y-m-d H:m:s');
$anhcu = $row_bv['img'];

if(isset($_POST['update']) && isset($_POST['TieuDe']) && isset($_POST['NoiDung'])) {
    if ($_FILES['file']['name'] != null)// người dùng  chọn ảnh mới => không thay đổi ảnh
    {
            /*file hợp lệ và tiến hành upload*/
            $path = "../images/"; // file lưu vào thư mục images
            $tmp_name = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $type = $_FILES['file']['type'];
            $size = $_FILES['file']['size'];
            if (file_exists($path . $_FILES["file"]["name"]))// dò trùng ảnh trong folder
            {
                echo "<script language='javascript'>alert('Tên ảnh đã tồn tại!');</script>";
            } else /// không trùng tên trong folder
            {

                $q_up_baiviet = "update baiviet
                        set idSP=" . $_POST['idSP'] . ",TieuDe=N'" . $_POST['TieuDe'] . "',NoiDung=N'" . $_POST['NoiDung'] . "',
                        NgayCapNhat='" . $ngaycapnhat . "',AnHien=" . $_POST['AnHien'] . ",MoTa =N'" . $_POST['MoTa'] . "',img='" . $name . "'
                        where idBV =" . $_GET['idBV'];
                $rs_up_baiviet = mysqli_query($conn, $q_up_baiviet);
                if ($rs_up_baiviet) {
                    unlink('../images/' . $anhcu);// xóa ảnh
                    // upload file
                    move_uploaded_file($tmp_name, $path . $name);
                    echo "<script language='javascript'>alert('Cập nhật thành công');";
                    echo "location.href = 'baiviet.php';</script>";
                } else
                    echo "<script language='javascript'>alert('Cập nhật không thành công');";
            }
    }
    else// người dùng k thay đổi ảnh
    {
        // cập nhật thông tin ngoại trừ ảnh
        $q_up_baiviet = "update baiviet
                        set idSP=" . $_POST['idSP'] . ",TieuDe=N'" . $_POST['TieuDe'] . "',NoiDung=N'" . $_POST['NoiDung'] . "',
                        NgayCapNhat='" . $ngaycapnhat . "',AnHien=" . $_POST['AnHien'] . ",MoTa =N'" . $_POST['MoTa'] . "'
                        where idBV =" . $_GET['idBV'];
        $rs_up_baiviet = mysqli_query($conn, $q_up_baiviet);
        if ($rs_up_baiviet) {
            echo "<script language='javascript'>alert('Cập nhật thành công');";
            echo "location.href = 'baiviet.php';</script>";
        } else
            echo "<script language='javascript'>alert('Cập nhật không thành công');";
    }
}

if(isset($_POST['delete'])) {
$q_delete_bv = "delete  from baiviet where idBV =".$_GET['idBV'];
$rs_delete_bv = mysqli_query($conn, $q_delete_bv);
if ($rs_delete_bv) {
    if (file_exists('../images/'. $anhcu))// dò xem có ảnh trong folder k
    {
        if (is_file('../images/' . $anhcu))// xóa ảnh cũ:
        {
            unlink('../images/' . $anhcu);
        }

    }
echo "<script language='javascript'>alert('Xóa thanh cong');";
    echo "location.href = 'baiviet.php';</script>";
} else
echo "<script language='JavaScript'> alert('Xóa  không thành công!');</script>";
}
?>
