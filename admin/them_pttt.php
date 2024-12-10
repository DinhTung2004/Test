<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Phương Thức Thanh Toán </title>
    <?php include_once('header2.php');?>
    <style> div.row {padding-top: 2%;}</style>
</header>
<body >
<?php
include ('../connection/connect_database.php');
if(isset($_POST['TenPhuongThucTT']) && isset($_POST['ok']) )
{

    $sl_pttt= "select * from phuongthucthanhtoan";
    $rs_pttt = mysqli_query($conn,$sl_pttt);
    if(!$rs_pttt)
    {
        echo "<script language='javascript'>alert('Thêm thành công');";
        echo "location.href = 'index_pttt.php'</script>";
    }
    $check = false; // biến kiểm tra trùng tên
    while ($r = $rs_pttt->fetch_assoc())
    {
        if($r['TenPhuongThucTT'] == $_POST['TenPhuongThucTT'])
        {
            $check = true;
        }
    }
    if($check == false)
    {
        $query = "INSERT INTO phuongthucthanhtoan(TenPhuongThucTT,GhiChu,AnHien) values ('".$_POST['TenPhuongThucTT']."','".$_POST['GhiChu']."','".$_POST['AnHien']."')";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo "<script language='javascript'>alert('Thêm thành công');";
            echo "location.href = 'index_pttt.php'</script>";
        }
        else
            echo "<script language='javascript'>alert('Thêm không thành công');</script>";
    }else
        echo "<script language='JavaScript'> alert('Tên loại đã tồn tại!');</script>";

}
?>
<?php include_once ('header3.php');?>
<h3 style="text-align: center">PHƯƠNG THỨC THANH TOÁN  </h3>
<form  method="post" action="" name="ThemPTTT" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên PTTT</strong></div>
        <div class="col-md-9"><input type="text" name="TenPhuongThucTT"></div>
    </div>

    <div class="row">
        <div class="col-md-2"><strong>Ghi Chú</strong></div>
        <div class="col-md-9"><input type="text" id="GhiChu" name="GhiChu"></div>
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
            location.href = 'index_pttt.php'
        }
    }
</script>
</form>
<?php include_once ('footer.php');?>
</body>
</html>