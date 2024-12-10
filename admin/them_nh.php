<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 17:16
 */
?>
<!DOCTYPE html>
<html>
<header>
<?php include_once ("header1.php");?>
<title>Thêm Nhãn Hiệu </title>
<?php include_once('header2.php');?>
    <style>
        div.row {padding-top: 2%;}
    </style>
</header>
<body>
<?php
include ('../connection/connect_database.php');
if(isset($_POST['TenNH']) && isset($_POST['ok']) )
{

    $sl_nhanhieu = "select * from nhanhieu";
    $rs_nhanhieu = mysqli_query($conn,$sl_nhanhieu);
    if(!$rs_nhanhieu)
    {
        echo "<script language='javascript'>alert('Thêm thành công');";
        echo "location.href = 'index_nh.php'</script>";
    }
    $check = false; // biến kiểm tra trùng tên
    while ($r = $rs_nhanhieu->fetch_assoc())
    {
        if($r['TenNH'] == $_POST['TenNH'])
        {
            $check = true;
        }
    }
    if($check == false)
    {
        $query = "INSERT INTO nhanhieu(TenNH,idL,ThuTu,AnHien) values ('".$_POST['TenNH']."',".$_POST['idL']." ,  ".$_POST['ThuTu'].",".$_POST['AnHien'].")";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo "<script language='javascript'>alert('Thêm thành công');";
            echo "location.href = 'index_nh.php'</script>";
        }
        else
            echo "<script language='javascript'>alert('Thêm không thành công');</script>";
    }else
        echo "<script language='JavaScript'> alert('Tên loại đã tồn tại!');</script>";

}
?>
<?php include ('../connection/connect_database.php');?>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">THÊM NHÃN HIỆU </h3>
<form  method="post" action="" name="ThemNH" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên nhãn hiệu</strong></div>
        <div class="col-md-9"><input type="text" name="TenNH"></div>
    </div>
    <div class="row">
            <div class="col-md-2"><strong>Loại</strong></div>
            <div class="col-md-9"><?php
                $sl_l = "select * from loaisp";
                $rs_l = mysqli_query($conn,$sl_l);
                if(!$rs_l)
                    echo "Không thể truy vấn CSDL";?>
                <select name="idL">
                    <?php while ($row_l = $rs_l->fetch_assoc()) { ?>
                        <option value="<?php echo $row_l["idL"];?>"><?php echo $row_l['TenL'];?></option>
                    <?php }?>
                </select>
            </div>
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