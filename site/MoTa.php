<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 17-Mar-17
 * Time: 23:38
 */?>
<?php include ('../connection/connect_database.php'); ?>
<?php
if(isset($_GET['idSP']))
{
    $idSP=1;
    $idSP= (int)$_GET['idSP'];
    $sql = "select * from sanpham_hinh where idSP=".$idSP;
    $result = mysqli_query($conn,$sql);
    $sql1 = "select * from sanpham_hinh where idSP=".$idSP;
    $result1 = mysqli_query($conn,$sql1);
    $sl ="select * from sanpham where idSP=".$idSP;
    $rs_sp = mysqli_query($conn,$sl);
    $sql_comment="select * from sanpham_comment where idSP=".$idSP;
    $rs_cm=mysqli_query($conn,$sql_comment);
}
else
{
    echo "<script language='javascript'>alert('Không thể kết nối !');";
    echo "location.href='index.php?index=1';</script>";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<header>
    <?php include_once ("header.php");?>
    <title>Trang chủ</title>
    <?php include_once ("header1.php");?>
    <?php include ('../connection/connect_database.php');?>
    <?php include ('../libs/lib.php');?>
    <style>
        .box{ border-radius: 2%;}
        .box.hover{border-color: green;}
        .boxsizing {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            width: 180px;
            height: 182px;
            border: 1px solid blue;
        }
        div.row{padding-top: 2%;}

        .buyproduct{ background-color: #fbc902;}
    </style>
    <style type="text/css">

        .hovergallery:hover{
            -webkit-transform:scale(1.2); /*Webkit: Scale up image to 1.2x original size*/
            -moz-transform:scale(1.2); /*Mozilla scale version*/
            -o-transform:scale(1.2); /*Opera scale version*/
            box-shadow:0px 0px 30px gray; /*CSS3 shadow: 30px blurred shadow all around image*/
            -webkit-box-shadow:0px 0px 30px gray; /*Safari shadow version*/
            -moz-box-shadow:0px 0px 30px gray; /*Mozilla shadow version*/
            opacity: 1;
        }
    </style>
    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
    <link rel="stylesheet" href="../css/layout.min.css" type="text/css">
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</header>
<body>

<?php include_once ("header2.php");?>
<h2 align="center"><strong>THÔNG TIN SẢN PHẨM</strong></h2>
<div class="container">
    <div class="row">
            <div class="col-md-6" style="background-color: #fff">
                <div class="wrapper">
                <div class="row">
                        <div class="flexslider">
                            <ul class="slides">
                            <?php
                            while($r = $rs_sp->fetch_assoc()) {
                                while( $row1 = $result1->fetch_assoc()) {?>
                                <li ><img  src="../images/<?php echo $row1['urlHinh']; ?>"> </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-6" >
            <form method="post" action="" name="ThemUser" enctype="multipart/form-data">
                <div class="row"><h4><strong><div><?php echo $r['TenSP'];?></div></strong></h4></div>
                <div class="row">
                    <div class="col-md-3" ><strong>Ngày cập nhật: </strong></div>
                    <div class="col-md-9"><?php echo $r['NgayCapNhat'];?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Giá bán: </strong></div>
                    <div class="col-md-9" style="color: #dd0017;"><span class="money" style="font-size: 120%;"><b><?php echo number_format($r['GiaBan']);?> VND</b></span></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Tình trạng: </strong></div>
                    <div class="col-md-9"><?php if($r['SoLuongTonKho']>0) echo "Còn hàng"; else echo "Hết hàng";?></div>
                </div>
                <div class="row">

                       <?php  if($r['SoLuongTonKho']==0) {
                           echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\">Thêm vào giỏ</button>";
                       }else
                       {?><button  style="margin-left: 75px;" id="mua" name="mua"  class="btn btn-primary">
                        <a style="color:white;" href="../site/GioHang.php?idSP=<?php echo $_GET['idSP'];?> " >Thêm vào giỏ </a> </button><?php }?>

                </div>
                <div class="row">
                    <div class="row">
                        <div  class="prod-box">
                            <div class="col-md-13"><?php echo $r['MoTa'];?></div>
                        </div>
                    </div>
                </div>
                <?php }?>
        </div>
    </div>
    <div class="row"><strong>Bình luận</strong></div>
    <?php while($row_cm=$rs_cm->fetch_assoc()){
    ?>
       <div class="row" style="color: darkblue; margin-left:2px;font-size: 150%; font-family: 'Microsoft Sans Serif' , Arial, Helvetica, Verdana;margin-bottom: -20px;">
          <img src="../images/avatar-icon.png" width="50" height="50"> <strong><?php echo $row_cm['hoten'];?></strong>
       </div>
        <div style="margin-left: 58px; "><i><?php echo $row_cm['ngay_comment']; ?></i></div>
        <div class="prod-box"><?php echo $row_cm['noidung'];?></div>
    <?php }?>
    <?php
    if(isset($_POST['binhluan'])) {
        if (!isset($_SESSION['Username'])) {
            echo "<script language='javascript'>alert('Bạn phải đăng nhập!');";
            header('location: ../site/DangNhap.php');
        } else {
            $sl_cm = "insert into sanpham_comment(idSP,hoten,noidung,ngay_comment,kiem_duyet) VALUES('" . $_GET['idSP'] . "','" . $_SESSION['Username'] . "','" . $_POST['comment'] . "','" . date("Y-m-d h:i:s") . "',1) ";
            $rs_themcm = mysqli_query($conn, $sl_cm);
            if ($rs_themcm) {
                ?>
                <div class="row" style="color: darkblue; margin-left:2px;font-size: 150%; font-family: 'Microsoft Sans Serif' , Arial, Helvetica, Verdana;margin-bottom: -20px;">
                    <img src="../images/avatar-icon.png" width="50" height="50">
                    <strong><?php echo $_SESSION['Username']; ?></strong>
                </div>
                <div style="margin-left: 58px;"><i><?php echo date("Y-m-d h:i:s"); ?></i></div>
                <div class="prod-box"><?php echo $_POST['comment']; ?></div>
            <?php } else {
                echo "<script language='javascript'>alert('Thêm không thành công!');</script>";
            }
        }
    }
    ?>
    <div class="row">
        <textarea name="comment" id="comment" rows=""></textarea>
    </div>
        <script type="text/javascript">
            CKEDITOR.replace('comment');
        </script>
    <div class="row">
        <button id="binhluan" name="binhluan"  class="btn btn-success">Bình luận</button>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông tin</h4>
            </div>
            <div class="modal-body">
                <p ><strong>Sản phẩm này tạm hết hàng. Bạn vui lòng chọn sản phẩm khác!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php include_once ("footer.php");?>
</body>
</html>

