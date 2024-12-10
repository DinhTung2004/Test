<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 12-May-17
 * Time: 23:26
 */
if(!isset($_SESSION))
{
    session_start();ob_start();
}
$idSP =(int)$_GET['idSP'];
include ("../connection/connect_database.php");
$product = array();
$sl_sanpham = "select * from sanpham";
$rs_sanpham = mysqli_query($conn,$sl_sanpham);
while ($r= $rs_sanpham->fetch_assoc())
{
    if($r['idSP'] == 1) continue;
    $tennh="Chưa xác định";
    $sl_nh = "select * from nhanhieu WHERE idNH=".$r['idNH'];
    $rs_nh = mysqli_query($conn,$sl_nh);
   while ($r_tennh = $rs_nh->fetch_assoc())
   {
           $tennh = $r_tennh['TenNH'];
   }
    $product[] = array("idSP"=>$r['idSP'],"TenSP" =>$r['TenSP'],"GiaBan" =>$r['GiaBan'],"urlHinh" => $r['urlHinh'],"TenNH"=>$tennh,"SoLTon"=>$r['SoLuongTonKho']);
}
$newproduct = array();
foreach ($product as $val)
{
    $newproduct[$val['idSP']] = $val;
}
if((!isset($_SESSION['cart']) || isset($_SESSION['cart']) == null )&& $idSP !=1) // giỏ rỗng
{
    $newproduct[$idSP]['qty'] =1;
    $_SESSION['cart'][$idSP] = $newproduct[$idSP];/// đua sp vào giỏ
}else// giỏ đã có hàng
{
    if($idSP !=1)
    {
        if(array_key_exists($idSP,$_SESSION['cart']))///// kiểm tra xem đã có sp này trong giỏ hay chưa
        {
            //// nếu có thì tăng số lượng của sản phẩm đó, không thêm vào giỏ
            $_SESSION['cart'][$idSP]['qty'] +=1;
        }else{
            //// nếu không thì thêm vào giỏ
            $newproduct[$idSP]['qty'] =1;
            $_SESSION['cart'][$idSP] = $newproduct[$idSP];
        }
    }

}
$so =0;
if(isset($_SESSION['cart']))
    $so = count($_SESSION['cart']);
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header.php");?>
    <title>Giỏ hàng</title>
    <?php include_once ("header1.php");?>
    <style>
        .glyphicon.glyphicon-pencil{ color: #1fb3f6;}
    </style>
<?php
echo "<script>$('#x').click(function(event){
    $('#myModal').hide();
$('.modal-backdrop').hide(); 

});</script>";
if($_GET['idSP'] ==1)
{
    echo "<script language='JavaScript'>
$('#myModal').hide();
$('.modal-backdrop').hide();
</script>";
}
   else
       echo " <script language=\"JavaScript\">
       $(window).on('load',function(){
           $('#myModal').modal('show');
        });
  </script>"?>;

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->

    <!-- end JS-->
    <style> .ngang{
    background-color: #332c68;
    margin-top: 2%;
    margin-bottom: 2%;
}
    </style>
</header>
<body>
<?php include_once ("header2.php");?>
<!---- Nội dung---->
<div class="content">
    <!-----Thông tin giỏ hàng------>
    <h2><p><b>Giỏ hàng của tôi</b></p></h2>
    <?php echo "Có ".$so." "."sản phẩm bạn đã chọn";?>
    <div class="row">
        <div class=" col-md-8">
            <div class=" row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="row"></div>
                    <div class="row"></div>
                </div>
                <div class="col-md-3"><b>Giá/Tổng</b></div>
                <div class="col-md-2"><b>Số lượng</b></div>
                <div class="col-md-1"><b>Xóa</b></div>
            </div>
        </div>
    </div>
    <div class="row"><div class=" col-md-12" style="background-color: #5a5355;"></div></div>
    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

<div class="row">
    <div class=" col-md-8">
        <?php $tongtien =0;
        if($so ==0)
        {
            echo"<div class='row' align='center'><h2><b>Chưa có hàng nào trong sản phẩm của bạn. Mời bạn lựa chọn sản phẩm!</b></h2></div>";

        }
        else
        {
        foreach ($_SESSION['cart'] as $list)
        { $tongtien += (int)$list['qty']*$list['GiaBan'];?>
            <div class=" row" style="margin-bottom: 2%;background-color:#F5F5F5;">
                <div class="col-md-2"><a href="MoTa.php?idSP=<?php echo $list['idSP'];?>"> <img height="100%" style=" margin-top: 10%" width="70%" src="../images/<?php echo $list['urlHinh'];?>"></a></div>
                <div class="col-md-4">
                    <div class="row"><?php echo $list['TenSP'];?></div>
                    <div class="row"><?php echo $list['TenNH'];?></div>
                    <div class="row">
                        <?php if((int)$list['SoLTon'] <=10)
                            echo "<span style='color: #77ac3f;'> Chỉ còn ".$list['SoLTon']." sản phẩm trong kho </span>";
                        else
                            echo "<span style='color: #77ac3f;' class='glyphicon glyphicon-ok'>Còn hàng</span>";?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="row"><?php echo number_format($list['GiaBan'],0)."VNĐ";?></div>
                    <div class="row"><?php echo "<b style='color: firebrick;'>Tổng tiền</b>";?></div>
                    <div class="row"><?php echo "<b style='color: firebrick;'>". number_format((int)$list['qty']*$list['GiaBan'],0)."VNĐ</b>";?></div>
                </div>
                <div class="col-md-3"><form action="" method="post">
                        <div class="form-group">
                           <?php if($list['qty']< (int)$list['SoLTon']) {?> <a href="Tang_SL.php?idSP=<?php echo $list['idSP'];?>" class="addcartbtn" onclick="AddCart"><img src="../images/plus.png"></a><?php }?>
                            <input id="<?php echo $r['idSP']."SL";?>" name="<?php echo $r['idSP']."SL";?>" class="form-control bfh-number" type="text" value="<?php echo $list['qty'];?>" min="1" max="<?php echo (int)$list['SoLTon'];?>" />
                            <?php if($list['qty']>1) {?> <a href="Giam_SL.php?idSP=<?php echo $list['idSP'];?>" class="addcartbtn" onclick="AddCart"><img src="../images/minus.png"></a><?php }?>
                        </div></form>
                </div>
                <div class="col-md-1"> <a href="Xoa_Gio_Hang.php?idSP=<?php echo $list['idSP'];?>">Xóa</a></div>
            </div>
        <?php }}?>

    </div>
    <div class="col-md-4">
            <div class="row">
                <div class="col-md-12"><h3><b>Thông tin đơn hàng</b></h3></div>
                 <div class="col-md-12 ngang"></div>
            </div>
            <div class="row">
                <div class="col-md-6"><strong>Tạm tính</strong></div>
                <div class="col-md-6"><strong style="color: firebrick"><?php echo number_format($tongtien,0);?></div>
                <div class="col-md-12 ngang"></div>
            </div>
            <div class="row">
                <div class="col-md-12"> <strong>Tổng tiền (Tổng tiền thanh toán) : </strong><strong style="color: firebrick"><?php echo  number_format($tongtien);?></strong></div>
            </div>
                <div class="row">
                    <div class="col-md-12 ngang"></div>
                    <div class="col-md-6"><a href='index.php?index=1'><button type="button" class="btn btn-info">Tiếp tục mua hàng</button></a></div>
                    <div class="col-md-6"><a href='ThanhToan.php'><button type="button" class="btn btn-info">Thanh toán</button></a></div>
                </div>
    </div>
</div>

</div>

<div class="row"  style="padding-top: 3%;"><div class=" col-md-12" style="background-color: #5a5355;"></div></div>

<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button id="x" type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="row" align="center"><img src="../images/Cart.png" width="30px" height="30px" alt="logo">
                        <span class="modal-title" ><b>Giỏ hàng của bạn</b></span></div>
                </div>
                <div class="modal-body">

                    <?php
                    if(isset($_SESSION['cart']) && $_SESSION['cart'] == null) {
                        echo "<p>Không có sản phẩm nào trong giỏ hàng</p>";
                        echo "<div><a href='index.php?index=1'>Tiếp tục mua hàng</a> </div>";
                    }
                    else
                    {  echo "<p style='color: #00d247'><span class='glyphicon glyphicon-ok'></span> Một sản phẩm mới đã được thêm vào giỏ hàng của bạn</p>";?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6"><img src="../images/<?php echo $newproduct[$idSP]['urlHinh'];?>"></div>
                                    <div class="col-lg-6"><p><h4><?php echo $newproduct[$idSP]['TenSP'];?></h4></p>
                                        <p><?php echo number_format($newproduct[$idSP]['GiaBan'],0);?></p></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" row"><strong>Giỏ hàng của tôi  </strong> (<?php echo $so;?> sản phẩm)  <span  data-dismiss="modal" aria-label="Close" class="glyphicon glyphicon-pencil"></span></div>
                                <div class=" row"><strong>Tạm tính:  </strong> <?php echo number_format($so*$newproduct[$idSP]['GiaBan'],0);?> VNĐ </div>
                                <div class=" row"><strong>Nhãn hiệu:  </strong> <?php echo $newproduct[$idSP]['TenNH'];?>  </div>
                                <div class="row"><hr></div>
                                <div class="row">
                                    <div class="col-md-6"><a href='index.php?index=1'>Tiếp tục mua hàng</a></div>
                                    <div class="col-md-6"></div><a href='../site/ThanhToan.php'>Đặt hàng</a></div>
                            </div>

                            </div>
                        </div>
                    <?php }?>
                </>

            </div>

        </div>
    </div>

    <!------>
<?php include_once ("footer.php");?>
<script src="../js/jquery-1.11.2.min.js" ></script>
<script src="../js/bootstrap.min.js" ></script>



</body>
</html>
