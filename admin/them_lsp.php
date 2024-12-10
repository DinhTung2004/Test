<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 17:17
 */?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Thêm Loại Sản Phẩm </title>
    <?php include_once('header2.php');?>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <style> div.row {padding-top: 2%;}</style>
</header>
<body>
<?php
include ('../connection/connect_database.php');
if(isset($_POST['TenL'])  && isset($_POST['ok']) )
{

        $sl_loaisp = "select * from loaisp ";
        $rs_loaisp = mysqli_query($conn,$sl_loaisp);
        if(!$rs_loaisp)
        {
            echo "<script language='javascript'>alert('Lỗi try vấn dữ liệu!');";
            echo "location.href = 'index_ds_loaisp.php'</script>";
        }
    $check = false; // biến kiểm tra trùng tên
    while ($r = $rs_loaisp->fetch_assoc())
    {
        if($r['TenL'] == $_POST['TenL'])
        {
            $check = true;
        }
    }
    if($check == false)
    {
        $query = "INSERT INTO loaisp(TenL,ThuTu,AnHien) values ('".$_POST['TenL']."',".$_POST['ThuTu'].",".$_POST['AnHien'].")";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo "<script language='javascript'>alert('Thêm thành công');";
            echo "location.href = 'index_ds_loaisp.php'</script>";
        }
        else
            echo "<script language='javascript'>alert('Thêm không thành công');</script>";
    }else
        echo "<script LANGUAGE='JavaScript'> alert('Tên loại đã tồn tại!');</script>";

}
?>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">THÊM LOẠI SẢN PHẨM </h3>
<form  method="post" action="" name="ThemLSP" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên loại nước hoa</strong></div>
          <div class="col-md-9"><input type="text" name="TenL"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Thứ tự</strong></div>
        <div class="col-md-9"><input type="number" name="ThuTu"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <option value="1"> <strong>Hiện</strong></option>
                <option value="0"> <strong>Ẩn</strong></option>
            </select>
        </div>
    </div>
    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input name="ok" type="submit" value="Ok" />
            <input name="reset" type="reset" value="Tạo Lại">
            <input type="button" name="Huy" value="Hủy" onclick="getConfirmation()";>
        </div>
    </div>
</form>
<script type="text/javascript">
    function getConfirmation(){
        var retVal = confirm("Bạn có muốn hủy ?");
        if( retVal == true ){
            location.href = 'index_ds_loaisp.php'
        }
    }
</script>
<?php include_once ('footer.php');?>
</body>
</html>
