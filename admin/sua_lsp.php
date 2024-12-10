<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 17:17
 */
include_once ('../connection/connect_database.php');
$sl = "select * from loaisp where idL='".$_GET['idL']."'";
$kq = mysqli_query($conn,$sl);
if (! $kq) {
    echo "<script language='javascript'>alert('Lỗi truy vấn!');";
           echo "location.href='index_ds_loaisp.php';</script>";
}
$r_lsp=mysqli_fetch_array($kq);
if(isset($_POST['xoa']))// thao tác xóa
{
    $sql_nh = "update nhanhieu set idL=1 WHERE idL=".$_GET['idL'];//// thay đổi thể loại của nhãn hiệu này thành 1(mã loại mặc định)
    $rs_nh = mysqli_query($conn,$sql_nh);
    $sl = "delete from loaisp where idL=". $_GET['idL'];
    $kq = mysqli_query($conn, $sl);
    if($kq)
    {
        echo "<script language='javascript'>alert('Xóa thành công!');";
        echo "location.href='index_ds_loaisp.php';</script>";
    }
    else
        echo "<script language='javascript'>alert('Xóa không thành công!');";
}
if(isset($_POST['sua']))/// thao tác sửa
{
    if(isset($_POST['TenL']))
    {
        $check = false; // biến kiểm tra trùng tên
        $sql_lsp = "select TenL from loaisp WHERE idL <>".$_GET['idL'];
        $kq = mysqli_query($conn,$sql_lsp);
        while ($r = $kq->fetch_assoc())
        {
            if($r['TenL'] == $_POST['TenL'])
            {
                $check = true;// trùng tên
            }
        }
        if($check == false)
        {
            $query ="UPDATE loaisp set TenL ='". $_POST["TenL"]. "',
		ThuTu ='". $_POST["ThuTu"]. "',
		AnHien ='". $_POST["AnHien"]."' where  idL=". $_GET["idL"];
            $result_lsp = mysqli_query($conn, $query);
            if (! $result_lsp) {
                echo "<script language='javascript'>alert('Cập nhật không thành công!');";}
            else
            {
                echo "<script language='javascript'>alert('Cập nhật thành công!');";
                echo "location.href='index_ds_loaisp.php';</script>";
            }
        }
        else
        {
            echo "<script language='javascript'>alert('Trùng tên loại sản phẩm!');</script>";

        }

    }
}

?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Sửa Loại Sản Phẩm </title>
    <?php include_once('header2.php');?>
    <style> div.row{ padding-top: 2%;}</style>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">SỬA LOẠI SẢN PHẨM </h3>
<form  method="post" action="" name="SuaLSP" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên loại nước hoa</strong></div>
        <div class="col-md-9"> <input type="text" name="TenL" value="<?php  echo $r_lsp['TenL']?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Thứ tự</strong></div>
        <div class="col-md-9"><input type="number" name="ThuTu" value="<?php echo $r_lsp['ThuTu']?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <option value="1" <?php if($r_lsp['AnHien']==1) echo "selected";?>> <strong>Hiện</strong></option>
                <option value="0" <?php if($r_lsp['AnHien']==0) echo "selected";?>><strong> Ẩn</strong></option>
            </select>
        </div>
    </div>
    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input name="sua" type="submit" value="Sửa" />
            <input name="xoa" type="submit" value="Xóa" />
            <input type="button" name="trove" value="Trỏ về" onclick="getConfirmation()";>
        </div>
    </div>

    <script type="text/javascript">
        function getConfirmation()
        {
            var retVal = confirm("Bạn có muốn hủy bỏ thao tác không?");
            if( retVal == true ){
                location.href = 'index_ds_loaisp.php'
            }
        }
    </script>


    <?php include_once ('footer.php');?>
</body>
</html>

