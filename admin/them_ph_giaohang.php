<?php
include ('../connection/connect_database.php');
if(isset($_POST['TenGH']) && isset($_POST['them']) )
{

    $sl_gh= "select * from phuongthucgiaohang";
    $rs_gh = mysqli_query($conn,$sl_gh);
    if(!$rs_gh)
    {
        echo "<script language='javascript'>alert('Thêm thành công');";
        echo "location.href = 'index_ptgh.php'</script>";
    }
    $check = false; // biến kiểm tra trùng tên
    while ($r = $rs_gh->fetch_assoc())
    {
        if($r['TenGH'] == $_POST['TenGH'])
        {
            $check = true;
        }
    }
    if($check == false)
    {
        $query = "INSERT INTO phuongthucgiaohang(TenGH,Phi,AnHien) values ('".$_POST['TenGH']."', ".$_POST['Phi'].",".$_POST['AnHien'].")";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo "<script language='javascript'>alert('Thêm thành công');";
            echo "location.href = 'index_ptgh.php'</script>";
        }
        else
            echo "<script language='javascript'>alert('Thêm không thành công');</script>";
    }else
        echo "<script language='JavaScript'> alert('Tên giao hàng đã tồn tại!');</script>";

}


?>

<!DOCTYPE html>
<html>
<header>
<?php include_once ("header1.php");?>
<title>THÊM PHƯƠNG THỨC GIAO HÀNG </title>
<?php include_once('header2.php');?>
    <style> div.row {padding-top: 2%;}</style>
</header>
<body >
<?php include_once ('header3.php');?>
<form  method="post" action="" name="ThemPTGH" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên giao hàng</strong></div>
        <div class="col-md-9"><input type="text" name="TenGH"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Phí</strong></div>
        <div class="col-md-9"><input type="number" name="Phi" value="0"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <option value="1"> <strong>1</strong></option>
                <option value="0"> <strong>0</strong></option>
            </select>
        </div>
    </div>

    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input name="them" type="submit" value="Thêm" />
            <input type="button" name="Huy" value="Hủy" onclick="getConfirmation()";>
        </div>
    </div>

</form>
<script type="text/javascript">
    function getConfirmation()
    {
        var retVal = confirm("Bạn có muốn hủy?");
        if( retVal == true ){
            location.href = 'index_ptgh.php'
        }
    }
</script>

<?php include_once ('footer.php');?>
</body>
</html>