<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 17:17
 */
include_once ('../connection/connect_database.php');
$sql = "select * from nhanhieu where idNH=".$_GET['idNH'];
$rs = mysqli_query($conn,$sql);
if (! $rs) {
    echo "<script language='javascript'>alert('Lỗi truy vấn!');";
    echo "location.href='index_nh.php';</script>";
}
$d=mysqli_fetch_array($rs);
if(isset($_POST['xoa']))// thao tác xóa
{
    $sql_nh = "update nhanhieu set idNH=1 WHERE idNH=".$_GET['idNH'];//// thay đổi thể loại của nhãn hiệu này thành 1(mã loại mặc định)
    $rs_nh = mysqli_query($conn,$sql_nh);
    $sl = "delete from nhanhieu where idNH=". $_GET['idNH'];
    $kq = mysqli_query($conn, $sl);
    if($kq)
    {
        echo "<script language='javascript'>alert('Xóa thành công!');";
        echo "location.href='index_nh.php';</script>";
    }
    else
        echo "<script language='javascript'>alert('Xóa không thành công!');";
}
if(isset($_POST['sua']))/// thao tác sửa
{
    if(isset($_POST['TenNH']))
    {
        $check = false; // biến kiểm tra trùng tên
        $sql_nh2 = "select TenNH from nhanhieu WHERE idNH <>".$_GET['idNH'];
        $kq = mysqli_query($conn,$sql_nh2);
        while ($r = $kq->fetch_assoc())
        {
            if($r['TenNH'] == $_POST['TenNH'])
            {
                $check = true;// trùng tên
            }
        }
        if($check == false)
        {
            $query ="UPDATE nhanhieu set TenNH ='". $_POST["TenNH"]. "',
            idL =". $_POST["idL"]. ",
		    ThuTu =". $_POST["ThuTu"]. ",
		    AnHien =". $_POST["AnHien"]." where  idNH=". $_GET["idNH"];
            $result_nh = mysqli_query($conn, $query);
            if (! $result_nh) {
                echo "<script language='javascript'>alert('Cập nhật không thành công!');";}
            else
            {
                echo "<script language='javascript'>alert('Cập nhật thành công!');";
                echo "location.href='index_nh.php';</script>";
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
    <title>Sửa Nhãn Hiệu</title>
    <?php include_once('header2.php');?>
    <style>
        div.row {padding-top: 2%;}
    </style>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">SỬA NHÃN HIỆU </h3>
<form  method="post" action="" name="SuaNH" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên nhãn hiệu</strong></div>
        <div class="col-md-9"><input type="text" name="TenNH" value="<?php echo $d['TenNH'] ?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Loại</strong></div>
        <div class="col-md-9"><?php
            $sl_l = "select * from loaisp";
            $rs_l = mysqli_query($conn,$sl_l);
            if(!$rs_l)
                echo "Không thể truy vấn CSDL";?>
            <select name="idL">
                <?php while ($r = $rs_l->fetch_assoc()) { ?>
                    <option value="<?php echo $r["idL"];?>"<?php if($d['idL']==$r["idL"]) echo "selected";?>><?php echo $r['TenL'];?></option>
                <?php }?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Thứ tự</strong></div>
        <div class="col-md-9"><input type="number" name="ThuTu" value="<?php echo $d['ThuTu']?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ẩn/Hiện</strong></div>
        <<div class="col-md-9">
            <select name="AnHien">
                <option value="1" <?php if($d['AnHien']==1) echo "selected";?>> <strong>Hiện</strong></option>
                <option value="0"> <?php if($d['AnHien']==0) echo "selected";?>><strong>Ẩn</strong></option>
            </select>
        </div>
    </div>
    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input name="sua" type="submit" value="Sửa" />
            <input name="xoa" type="submit" value="Xóa" />
            <input type="button" name="Huy" value="Hủy" onclick="getConfirmation()";>
        </div>
    </div>

    <script type="text/javascript">
        function getConfirmation()
        {
            var retVal = confirm("Bạn có muốn hủy?");
            if( retVal == true ){
                location.href = 'index_nh.php'
            }
        }
    </script>


    <?php include_once ('footer.php');?>
</body>
</html>