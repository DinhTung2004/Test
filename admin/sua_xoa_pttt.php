<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Sửa Xóa Phương Thức Thanh Toán </title>
    <?php include_once('header2.php');?>
    <style> div.row {padding-top: 2%;}</style>
</header>
<body >
<?php include_once ('../connection/connect_database.php');
$sql = "select * from phuongthucthanhtoan where idPTTT=".$_GET['idPTTT'];
$rs = mysqli_query($conn,$sql);
if (! $rs) {
echo "<script language='javascript'>alert('Lỗi truy vấn!');";
    echo "location.href='index_pttt.php';</script>";
}
$d=mysqli_fetch_array($rs);
if(isset($_POST['Sua']))//sửa
{
    if(isset($_POST['TenPhuongThucTT']))
    {
        $check = false; // biến kiểm tra trùng tên
        $sql_pttt = "select TenPhuongThucTT from phuongthucthanhtoan WHERE idPTTT <>".$_GET['idPTTT'];
        $kq = mysqli_query($conn,$sql_pttt);
        while ($r = $kq->fetch_assoc())
        {
            if($r['TenPhuongThucTT'] == $_POST['TenPhuongThucTT'])
            {
                $check = true;// trùng tên
            }
        }
        if($check == false)
        {
            $query ="UPDATE phuongthucthanhtoan set TenPhuongThucTT ='". $_POST["TenPhuongThucTT"]. "',            
            GhiChu ='". $_POST["GhiChu"]. "',
            AnHien ='". $_POST["AnHien"]."' where  idPTTT=". $_GET["idPTTT"];
            $result_pttt = mysqli_query($conn, $query);
            if (! $result_pttt) {
                echo "<script language='javascript'>alert('Cập nhật không thành công!');";}
            else
            {
                echo "<script language='javascript'>alert('Cập nhật thành công!');";
                echo "location.href='index_pttt.php';</script>";
            }
        }
        else
        {
            echo "<script language='javascript'>alert('Trùng tên phương thức thanh toán!');</script>";

        }

    }
}
if(isset($_POST['Xoa'])  )// xóa
{
    if($_GET['idPTTT']!=1)
    {
        $sl = "delete from phuongthucthanhtoan where idPTTT=". $_GET['idPTTT'];
        $kq = mysqli_query($conn, $sl);
        if($kq)
        {
            echo "<script language='javascript'>alert('Xóa thành công!');";
            echo "location.href='index_pttt.php';</script>";
        }
        else
            echo "<script language='javascript'>alert('Xóa không thành công!');";
    }
    else
        echo "<script language='javascript'>alert('Không thể xóa phương thức thanh toán này. Đây là mặc định!');</script>";
}
?>
<?php include_once ('header3.php');?>
<h3 style="text-align: center">SỬA XÓA PHƯƠNG THỨC THANH TOÁN  </h3>
<form  method="post" action="" name="ThemPTTT" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên PTTT</strong></div>
        <div class="col-md-9"><input type="text" name="TenPhuongThucTT" value="<?php echo $d['TenPhuongThucTT'] ?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ghi Chú</strong></div>
        <div class="col-md-9"><input type="text" id="GhiChu" name="GhiChu" value="<?php echo $d['GhiChu'] ?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <option value="1" <?php if($d['AnHien']==1) echo "selected";?>> <strong>Hiện</strong></option>
                <option value="0" <?php if($d['AnHien']==0) echo "selected";?>> <strong>Ẩn</strong></option>
            </select>
        </div>
    </div>
    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input name="Sua" type="submit" value="Sửa" />
            <input name="Xoa" type="submit" value="Xóa" />
            <input type="button" name="Huy" value="Hủy" onclick="getConfirmation()";>
        </div>
    </div>
</form>
<script type="text/javascript">
    function getConfirmation(){
        var retVal = confirm("Bạn có muốn hủy ?");
        if( retVal == true ){
            location.href = 'index_pttt.php'
        }
    }
</script>
</form>
<?php include_once ('footer.php');?>
</body>
</html>