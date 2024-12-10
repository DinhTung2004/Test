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
</header>
<?php include_once ("header2_index.php");?>
        <!---- Nội dung---->
        <h3 align="center">NƯỚC HOA NỮ</h3>
        <body>

        <?php
        include_once ('../connection/connect_database.php');
        $sl_sanpham = "select * from sanpham WHERE AnHien=1 and idL=2";
        $rs_sanpham = mysqli_query($conn,$sl_sanpham);
        if(!$rs_sanpham)
        {
            echo "<script language='javascript'>alert('Không thể kết nối !');";
            echo "location.href='index.php?index=1';</script>";
        }?>
        <?php
        echo "<div class=\"row text-center\" style=\"margin-top:40px\">
    <div id=\"productlist\">";
        $n=0; while ($r= $rs_sanpham->fetch_assoc()) { if($r['idSP'] == 1) continue;
            echo "<div class=\"col-md-3 col-sm-6 col-xs-6\" style=\"margin-bottom:10px\">
                <div class=\"item\">
                    <div class=\"prod-box\">
                            <span class=\"prod-block\">";?>
            <a href="MoTa.php?idSP=<?php echo $r['idSP'];?>" class="hover-item"></a>
                               <?php echo " <span class=\"prod-image-block\">
                                    <span class=\"prod-image-box\">
                                        <img class=\"prod-image\" src=\"../images/"; echo $r['urlHinh'];echo"\"alt=\"\">
                                    </span>
                                </span>
                                    <span class=\"productname dislay-block limit limit-product\">";
            echo $r['TenSP'];echo"</span>
                                <span class=\"category dislay-block \">
                                        <span class=\"pricein168 dislay-block limit\"><span class=\"money\">";echo $r['GiaBan'];echo"</span>  VNĐ</span>
                                </span>
                            </span>
                        <a   href=\"GioHang.php?idSP="; echo $r['idSP']; echo" class=\"addcartbtn\" onclick=\"AddCart(1379)\"><img src=\"../images/xe.png\"></a>
                        <a style=\"color: #0e86c1;\"  href=\"MoTa.php?idSP="; echo $r['idSP']; echo" onclick=\"BuyNow(1379)\" class=\"btn btn-default buyproduct\"><strong>MUA HÀNG</strong></a>
                    </div>
                </div>
            </div>
";}
        echo" </div>
</div>";
        ?>

        <div class="row text-center" style="margin-top:40px">
            <div id="productlist">
                <?php $n=0; while ($r= $rs_sanpham->fetch_assoc()) { if($r['idSP'] == 1) continue;?>

                    <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom:10px">

                        <div class="item">

                            <div class="prod-box">
                            <span class="prod-block">
                                <a href="MoTa.php?idSP=<?php echo $r['idSP'];?>" class="hover-item"></a>
                                <span class="prod-image-block">
                                    <span class="prod-image-box">
                                        <img class="prod-image" src="../images/<?php echo $r['urlHinh'];?>"alt="">
                                    </span>
                                </span>
                                    <span class="productname dislay-block limit limit-product">
                                    <?php echo $r['TenSP'];?>
                                     </span>
                                <span class="category dislay-block ">
                                        <span class="pricein168 dislay-block limit"><span class="money"><?php echo number_format($r['GiaBan'],0);?></span>  VNĐ</span>
                                </span>
                            </span>
                                <a href="GioHang.php?idSP=<?php echo $r['idSP'];?>" class="addcartbtn" onclick="AddCart"><img src="../images/xe.png"></a>

                                <a href="MoTa.php?idSP=<?php echo $r['idSP'];?>" onclick="BuyNow(1379)" class="btn btn-default buyproduct"><strong>Xem HÀNG</strong></a>
                            </div>
                        </div>
                    </div>

                <?php }?>
            </div>
        </div>
        <?php include_once ("footer.php");?>
        </body>
</html>
